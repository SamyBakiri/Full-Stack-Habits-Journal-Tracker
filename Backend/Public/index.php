<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// create dotenv instance to read .env file and load()  will save the data in $__env[] super global vars
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$db_config = require __DIR__ . '/../Config/DB.php';


