<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Core\Router;


// create dotenv instance to read .env file , load() will save the data in $__env[] super global vars
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$router = new Router();

require __DIR__ . '/../Routes/api.php';

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);





