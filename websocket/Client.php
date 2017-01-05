<?php

namespace app\websocket;

use yii\base\Component;

class Client extends Component {

    public $url = '127.0.0.1';
    private $_sp;
    private $_err = '';
    private $_errno;
    private $_errstr;

    public function write($data, $final = true) {
        if ($this->open()) {
            // Assamble header: FINal 0x80 | Opcode 0x02
            $header = chr(($final ? 0x80 : 0) | 0x02); // 0x02 binary
            // Mask 0x80 | payload length (0-125) 
            if (strlen($data) < 126)
                $header .= chr(0x80 | strlen($data));
            elseif (strlen($data) < 0xFFFF)
                $header .= chr(0x80 | 126) . pack("n", strlen($data));
            elseif (PHP_INT_SIZE > 4) // 64 bit 
                $header .= chr(0x80 | 127) . pack("Q", strlen($data));
            else  // 32 bit (pack Q dosen't work)
                $header .= chr(0x80 | 127) . pack("N", 0) . pack("N", strlen($data));

            // Make a random mask
            $mask = pack("N", rand(1, 0x7FFFFFFF));
            $header .= $mask;

            // Apply mask to data
            for ($i = 0; $i < strlen($data); $i++)
                $data[$i] = chr(ord($data[$i]) ^ ord($mask[$i % 4]));

            fwrite($this->_sp, $header . $data);
            return $this;
        }
    }

    public function read($wait_for_end = true) {
        $out_buffer = "";

        do {
            // Read header
            $header = fread($this->_sp, 2);
            if (!$header)
                trigger_error("Reading header from websocket failed", E_USER_ERROR);
            $opcode = ord($header[0]) & 0x0F;
            $final = ord($header[0]) & 0x80;
            $masked = ord($header[1]) & 0x80;
            $payload_len = ord($header[1]) & 0x7F;

            // Get payload length extensions
            $ext_len = 0;
            if ($payload_len > 125)
                $ext_len += 2;
            if ($payload_len > 126)
                $ext_len += 6;
            if ($ext_len) {
                $ext = fread($this->_sp, $ext_len);
                if (!$ext)
                    trigger_error("Reading header extension from websocket failed", E_USER_ERROR);

                // Set extented paylod length
                $payload_len = $ext_len;
                for ($i = 0; $i < $ext_len; $i++)
                    $payload_len += ord($ext[$i]) << ($ext_len - $i - 1) * 8;
            }

            // Get Mask key
            if ($masked) {
                $mask = fread($this->_sp, 4);
                if (!$mask)
                    trigger_error("Reading header mask from websocket failed", E_USER_ERROR);
            }

            // Get application data 
            $data_len = $payload_len - $ext_len - ($masked ? 4 : 0);
            $frame_data = fread($this->_sp, $data_len);
            if (!$frame_data)
                trigger_error("Reading from websocket failed", E_USER_ERROR);

            // if opcode ping, reuse headers to send a pong and continue to read
            if ($opcode == 9) {
                // Assamble header: FINal 0x80 | Opcode 0x02
                $header[0] = chr(($final ? 0x80 : 0) | 0x0A); // 0x0A Pong
                fwrite($this->_sp, $header . $ext . $mask . $frame_data);

                // Recieve and unmask data
            } elseif ($opcode < 9) {
                $data = "";
                if ($masked)
                    for ($i = 0; $i < $data_len; $i++)
                        $data .= $frame_data[$i] ^ $mask[$i % 4];
                else
                    $data .= $frame_data;
                $out_buffer .= $data;
            }

            // wait for Final 
        }while ($wait_for_end && !$final);

        return $out_buffer;
    }

    private function open() {
        if (!$this->_sp) {


            $key = base64_encode(uniqid());

            // Make a GET header for upgrade request to websocket.
            $query = parse_url($this->url);
            $header = "GET "
                    . (isset($query['path']) ? "$query[path]" : "")
                    . (isset($query['query']) ? "?$query[query]" : "")
                    . " HTTP/1.1\r\nHost: "
                    . (isset($query['scheme']) ? "$query[scheme]://" : "")
                    . (isset($query['host']) ? "$query[host]" : "127.0.0.1")
                    . (isset($query['port']) ? ":$query[port]" : "")
                    . "\r\npragma: no-cache\r\n"
                    . "cache-control: no-cache\r\n"
                    . "Upgrade: WebSocket\r\n"
                    . "Connection: Upgrade\r\n"
                    . "Sec-WebSocket-Key: $key\r\n"
                    . "Sec-WebSocket-Version: 13\r\n"
                    . (isset($_SERVER['HTTP_COOKIE']) ? "cookie: $_SERVER[HTTP_COOKIE]\r\n" : "")
                    . "\r\n";

            // Connect to server  
            do {
                $this->_sp = @fsockopen((isset($query['scheme']) ? "$query[scheme]://" : "")
                                . $query['host'], $query['port'], $this->_errno, $this->_errstr, 1);
                if (!$this->_sp)
                    break;

                // Set timeouts
                stream_set_timeout($this->_sp, 3, 100);
                // stream_set_blocking($this->_sp, false);
                //Request upgrade to websocket 
                $len = fwrite($this->_sp, $header);
                if (!$len)
                    break;

                // Read response into an assotiative array of headers. Fails if upgrade to ws failes.
                $reaponse_header = fread($this->_sp, 1024);
            }while (false);

            // Errors
            if (!$this->_sp)
                $this->_err = "Unable to connect to event server: $this->_errstr ($this->_errno)";
            elseif (!$len)
                $this->_err = "Unable to send upgrade header to event server: $this->_errstr ($this->_errno)";
            elseif (!strpos($reaponse_header, " 101 ") || !strpos($reaponse_header, 'Sec-WebSocket-Accept: '))
                $this->_err = "Event server did not accept to upgrade connection to websocket."
                        . $reaponse_header;

            if ($this->_err) {
                @fclose($this->_sp);
                return false;
            }
        }
        return TRUE;
    }

}
