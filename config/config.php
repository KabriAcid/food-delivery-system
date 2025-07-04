<?php
require __DIR__ . '/../vendor/autoload.php';
date_default_timezone_set('Africa/Lagos');

// Error Reporting log
ini_set('display_errors', 1);
error_reporting(E_ALL);

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();