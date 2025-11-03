<?php
// includes/config.php
date_default_timezone_set('America/Sao_Paulo');

define('DB_HOST','pixelemfoco.com');
define('DB_NAME','u875203196_dbgeral');
define('DB_USER','u875203196_usergeral');
define('DB_PASS','Controle23$');

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    die('Erro BD: ' . $e->getMessage());
}
