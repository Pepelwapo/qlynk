<?php

$host   = 'localhost';
$dbname = 'joseju33_qlynkdb';
$user   = 'joseju33_devpp';
$pass   = 'fLn!vjk~z%z_';

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    error_log('QLynk Landing DB Error: ' . $e->getMessage());
    $pdo = null;
}