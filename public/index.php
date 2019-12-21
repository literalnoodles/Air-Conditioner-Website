<?php
require '../vendor/autoload.php';
require '../core/bootstrap.php';
use App\Core\{Router,request};
$routes = new Router;
$routes->load('../App/routes.php');
$routes->direct(request::return_url(),request::type());