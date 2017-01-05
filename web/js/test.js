function wsStart() {
            ws = new WebSocket("ws://127.0.0.1:8004/");
            ws.onopen = function() { $("#chat").append("<p>system: connection is open</p>"); };
            ws.onclose = function() { $("#chat").append("<p>system: the connection is closed, I try to reconnect</p>"); setTimeout(wsStart, 1000);};
            ws.onmessage = function(evt) {$("#chat").append("<p>"+evt.data+"</p>");};
        }

        wsStart();