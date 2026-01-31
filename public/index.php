<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// アプリケーションがメンテナンスモードかどうかを判定する...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composerオートローダーを登録する...
require __DIR__.'/../vendor/autoload.php';

// Laravelを初期化してリクエストを処理する...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
