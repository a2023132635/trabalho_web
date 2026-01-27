<?php
define('BASE_DIR', dirname(__DIR__) . '/');


$host = "localhost";
$user = "root";
$pass = "";
$dbname = "banco_novo";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
} catch(PDOException $e) {
    die("Erro na ligação: " . $e->getMessage());
}
?>