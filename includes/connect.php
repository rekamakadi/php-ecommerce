<?php

// Require Composer's autoload file
require __DIR__ . '../../vendor/autoload.php';

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$con=mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
if(!$con){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>