function wsStart() {
    ws = new WebSocket("wss://case-opener.com/ws/");
    
    ws.onopen = function () {
        
    };
    ws.onclose = function () {
        setTimeout(wsStart, 1000);
    };
    ws.onmessage = function (evt) {
        var data1 = JSON.parse(evt.data);
        var data = data1.new_prize;
        if(data.type == 'new_prize' && (data.case_id == case_id || case_id == 0)){
            $("#prize .win:last()").remove();
            $("#prize").prepend(data.html);
            $('.win:first()').animate({width: 'toggle'});
        }
        data = data1.lucky;
        if(data.type == 'lucky'){
            $("#lucky").html(data.html);
        }
    };
}

wsStart();
