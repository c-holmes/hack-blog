<?php 
require __DIR__ . '/vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
require_once('helpers.php');
require_once('connection.php');
require_once('views/layout.php');

?>

