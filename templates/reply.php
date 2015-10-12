<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>just married</title>
    <link rel='stylesheet' href='/css/top.css' type='text/css'/>
    <script  src="https://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
</head>
<body>
    <div id="wrap">
        <h1>メッセージを書く</h1>
        <div id='form_wrap'>
            <div class="form">
                <form method="post" action="/reply">
                <label for="message">message : </label>
                <textarea name="message" placeholder="是非一言お願いします"></textarea>

                <label for="from">From: </label>
                <input type="text" name="from" value="<?php echo htmlspecialchars($name) ?>">
                <input type="submit" class="submit" value="送信する" />
                </form>
            </div>
        </div>
    </div>
<script>
(function($) {
    $wrap = $('#form_wrap');
    $form = $wrap.find('.form');
    $submit = $wrap.find('.submit');

    var on = function() {
        $wrap.css('height', '776px')
             .css('top', '-200px');

        $form.css('height', '530px');

        $submit.css('z-index', 1).css('opacity', 1);
    }
    on();
})(jQuery);
</script>
</body>
</html>
