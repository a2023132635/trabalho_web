CREATE DATABASE IF NOT EXISTS banco_novo
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE banco_novo;

CREATE TABLE utilizadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    saldo DECIMAL(10,2) DEFAULT 0
);

CREATE TABLE movimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilizador_id INT,
    tipo VARCHAR(50),
    valor DECIMAL(10,2),
    descricao VARCHAR(255),
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id)
);


CREATE TABLE contas_poupanca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilizador_id INT UNIQUE,
    saldo DECIMAL(10,2) DEFAULT 0,
    criada_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilizador_id) REFERENCES utilizadores(id)
);

CREATE TABLE mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    assunto VARCHAR(150),
    mensagem TEXT,
    criada_em DATETIME DEFAULT CURRENT_TIMESTAMP
);