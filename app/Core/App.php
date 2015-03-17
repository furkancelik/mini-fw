<?php
use App\Core\Route as Route;

$route = Route::getInstance();
require __DIR__.'/../routes.php';
return $route;
//$route->start();

