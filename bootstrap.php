<?php
require_once('vendor/autoload.php');
require_once('controller/controller.php');

define('SLACK_WEBHOOK_URL', '');
define('SLACK_WEBHOOK_CHANNEL', '');

if (isset($_SERVER['env']) && $_SERVER['env'] === 'production') {
    //for prod
    define('ENV', 'production');
    define('FACEBOOK_APP_ID', '');
    define('FACEBOOK_APP_SECRET', '');
    define('FACEBOOK_APP_CALLBACK_URL', '');

} else {
    //for dev
    define('ENV', 'dev');
    define('FACEBOOK_APP_ID', '');
    define('FACEBOOK_APP_SECRET', '');
    //devはhttp
    define('FACEBOOK_APP_CALLBACK_URL', '');
}
