<?php
$host = "localhost"; 
$dbname = "banco_novo"; // Nome da base de dados
$user = "root"; // Utilizador padrão
$pass = ""; // Password

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro à base de dados: " . $e->getMessage());
}