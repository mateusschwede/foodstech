CREATE DATABASE foodstech CHARSET=utf8;
USE foodstech;

CREATE TABLE mesa (
    id INTEGER NOT NULL PRIMARY KEY
) CHARSET=utf8;

CREATE TABLE atendente (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    ativo BOOLEAN NOT NULL DEFAULT 1
) CHARSET=utf8;

CREATE TABLE item (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    preco FLOAT NOT NULL,
    ativo BOOLEAN NOT NULL DEFAULT 1
) CHARSET=utf8;

CREATE TABLE comanda (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dtAbertura DATETIME NOT NULL DEFAULT now(),
    dtFechamento DATETIME,
    totComanda FLOAT,
    cpfCliente VARCHAR(15),
    idMesa INTEGER NOT NULL,
    idAtendente INTEGER NOT NULL
) CHARSET=utf8;

CREATE TABLE pedido (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idComanda INTEGER NOT NULL,
    idItem INTEGER NOT NULL,
    qtdItem INTEGER NOT NULL,
    totPedido FLOAT NOT NULL
) CHARSET=utf8;

INSERT INTO mesa(id) VALUES (1),(2),(3),(4),(5),(6),(7);
INSERT INTO atendente(nome) VALUES ("maicon"),("luciana");
INSERT INTO item(nome,preco) VALUES ("coca-cola 2l",10.20),("xis salada",16.50);
INSERT INTO comanda(idMesa,idAtendente) VALUES (1,1);
INSERT INTO pedido(idComanda,idItem,qtdItem,totPedido) VALUES (1,2,2,33);