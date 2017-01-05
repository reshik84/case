
    <div id="chat" style="overflow: auto;"><p>system: please wait, I try to connect to the server.</p></div>
    <div class="navbar-fixed-bottom">
        <form onsubmit="ws.send($('input').val()); $('input').val(''); return false; ">
            <input id="input" type="text" class="form-control" placeholder="Text input" style="width: 100%;" maxlength="140" autocomplete="off">
        </form>
    </div>

<?php $this->registerJsFile('/js/test.js') ?>
