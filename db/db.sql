CREATE DATABASE IF NOT EXISTS cooperativa;
USE cooperativa;

CREATE TABLE produtores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100)
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produtor INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    foto VARCHAR(255),
    FOREIGN KEY (id_produtor) REFERENCES produtores(id) ON DELETE CASCADE
);

CREATE TABLE estabelecimentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco TEXT NOT NULL,
    descricao TEXT,
    foto VARCHAR(255)
);

CREATE TABLE produto_estabelecimento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT NOT NULL,
    id_estabelecimento INT NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES produtos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_estabelecimento) REFERENCES estabelecimentos(id) ON DELETE CASCADE
);