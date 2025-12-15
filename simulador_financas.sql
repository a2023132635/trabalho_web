CREATE DATABASE IF NOT EXISTS simulador_financas;
USE simulador_financas;

CREATE TABLE utilizadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    apelido VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE financas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    saldo DECIMAL(10,2) DEFAULT 0,
    poupanca DECIMAL(10,2) DEFAULT 0,
    divida DECIMAL(10,2) DEFAULT 0,
    data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES utilizadores(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE historico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    saldo_resultante DECIMAL(10,2) NOT NULL,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES utilizadores(id)
);

