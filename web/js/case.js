
function opencase(bal) {
    $('.case-box').effect('shake', {
        times: 4, direction: 'left', distance: 10
    }, 1000, function () {
        $('.case-box').effect('shake', {
            times: 5, direction: 'up', distance: 10
        }, 1500, function () {
            $('#more').removeClass('hidden');
            $('.prize_sum').removeClass('hidden');
            $('#img_open').addClass('hidden');
            $('#img_open2').removeClass('hidden');
            $('#bal').text(bal);

        obj = {
                'type': 'new_prize', 
                'case_id': case_id, 
            };
            ws.send(JSON.stringify(obj));

        })
    }
    );
}