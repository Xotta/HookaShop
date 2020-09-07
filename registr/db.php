<?php
$server = 'localhost:8889';
$user = 'root';
$password = 'root';
$db = 'auth';
$address_site ="";

$db = mysqli_connect($server, $user, $password, $db);



if (!$db) {
    echo "Не удается подключиться к серверу базы данных!";
    exit;
}