CREATE DATABASE crudproduto;
USE crudproduto;
CREATE TABLE produto 
(
   id INT PRIMARY KEY AUTO_INCREMENT,
   nome VARCHAR(200) NOT NULL,
   preco DECIMAL(10,2) NOT NULL,
   quantidade INT NOT NULL,
   descricao TEXT NULL,
   dataCadastro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
