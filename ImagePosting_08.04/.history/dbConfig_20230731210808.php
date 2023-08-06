<?php

$dbName = "mysql:host=localhost;dbname=yuibon";
$userName = "yuibonn_user";
$password = "yuibonn0900";

try {
    $db = new PDO($dbName, $userName, $password);
} catch (\Throwable $th) {
    exit();
}