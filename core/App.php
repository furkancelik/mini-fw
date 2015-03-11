<?php
require 'Route.php';
$route = new Route($_SERVER['REQUEST_URI']);
require 'Pages.php';
$route->start();
