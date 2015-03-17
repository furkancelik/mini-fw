<?php
if (file_exists('./vendor/autoload.php')) require_once './vendor/autoload.php';
else die("Autoload Dosyası Yok!");

if (!file_exists(__DIR__."/app/Core/App.php")) die("App Dosyası Bulunamadı!");
$app['route'] = require __DIR__."/app/Core/App.php";
$app['route']->start();

//$route = new \App\Core\Route($_SERVER['REQUEST_URI']);
//$route->start();