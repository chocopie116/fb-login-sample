<?php
require_once('../bootstrap.php');

$app = new \Slim\Slim([
    //'debug'          => (ENV === 'dev') ? true : false,
    'debug'          => false,
    'log.enabled'    => false,
    'templates.path' => __DIR__ . '/../templates/',
    ]);

$app->get('/', function() use ($app) {
    (new Controller($app))->showTop();
});

$app->get('/callback', function() use ($app) {
    (new Controller($app))->fbCallback();
});

$app->get('/reply', function() use ($app) {
    (new Controller($app))->reply();
});

$app->post('/reply', function() use ($app) {
    (new Controller($app))->saveReply();
});

$app->get('/complete', function() use ($app) {
    (new Controller($app))->complete();
});

$app->error(function (\Exception $e) use ($app) {
    $stderr = fopen( 'php://stderr', 'w' );
    fwrite($stderr, "[error] $e\n" );
    echo '<p>調子が悪そうです。<a href="/">TOP</a>からやり直してください</p>';
    echo '<img src="http://kura1.photozou.jp/pub/766/390766/photo/192433893_624.jpg">';
});

$app->notFound(function () use ($app) {
    $stderr = fopen( 'php://stderr', 'w' );
    fwrite($stderr, "[notice] not found\n" );
    echo '<p>ページがみつかりません。</p>';
    echo '<img src="http://kura1.photozou.jp/pub/766/390766/photo/192433893_624.jpg">';
});
$app->run();
