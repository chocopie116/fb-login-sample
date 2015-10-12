<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>just married</title>
    <script  src="https://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
    <link rel='stylesheet' href='/css/top.css' type='text/css'/>
</head>
<body>
    <div id="wrap">
        <h1>Message</h1>
        <div id='form_wrap'>
            <div class="form">
                <p>お世話になっております。</p>
                <label><br>
　この度私xxxxは、お付き合いをしていた1つ年上の一般の女性と結婚することになりました。穏やかな雰囲気の方で一緒にいてとても心が落ち着きます。<br>
　お世話になった恩師の方、友人の皆様への直接のご報告ができておらずすみません。なお挙式はyyyy年mm月dd日になります。<br>
近くに立ち寄ることがあれば是非ゴハンいきましょう。これからもよろしくお願いします。<br>
                </label>
                <a href="<?php echo $url; ?>" onClick="return window.confirm('送り主様の把握のためにFacebookログインをしてもよろしいでしょうか？')">
                    <input type="submit" class="submit" value="返信する" />
                </a>
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

    $wrap.bind('click', function() {
        on();
    });

    setTimeout(on, 3000);//3秒後にはopen
})(jQuery);
</script>
</body>
</html>
