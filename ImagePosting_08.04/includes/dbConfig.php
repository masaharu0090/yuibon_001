<?php

$dsn   = 'mysql:host=localhost;dbname=imageposting;charset=utf8mb4';
$user = 'yuibonn_user';
$pass = 'yuibonn0900';

try {
    $db = new PDO($dsn, $user, $pass,);
} catch (\Throwable $th) {
    exit();
}