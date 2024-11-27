-- DROP SCHEMA `ultramixrh` ;

CREATE SCHEMA IF NOT EXISTS `ultramixrh` DEFAULT CHARACTER SET utf8mb4 ;
USE `ultramixrh` ;

create table if not exists login (id int not null auto_increment primary key, usuario varchar(50), senha varchar(255));

select * from cargos;

CREATE TABLE IF NOT EXISTS funcionarios (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50),
  `cargo` VARCHAR(40),
  `CPF` INT(11),
  `data_admissão` DATE,
  `telefone` VARCHAR(14),
  `email` VARCHAR(50),
  PRIMARY KEY (`id`));


CREATE TABLE IF NOT EXISTS avaliacoes(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `funcionario_id` INT(11) NOT NULL,
  `produtividade` VARCHAR(100),
  `empenho` INTEGER,
  `relatorio` INTEGER,
  `recomenda_promoção` VARCHAR(20),
  PRIMARY KEY (`id`),
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `ultramixrh`.`funcionarios` (`id`));

CREATE TABLE IF NOT EXISTS `ultramixrh`.`banco_horas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `funcionario_id` INT(11) NOT NULL,
  `horas_em_banco` INT(11),
  `ferias` VARCHAR(40),
  `licencas` VARCHAR(40),
  PRIMARY KEY (`id`),
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `ultramixrh`.`funcionarios` (`id`));


CREATE TABLE IF NOT EXISTS `ultramixrh`.`cargos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(40) UNIQUE,
  `carga_horaria` INT(11),
  `funcao` VARCHAR(300),
  `salario` DOUBLE,
  PRIMARY KEY (`id`));


CREATE TABLE IF NOT EXISTS `ultramixrh`.`fornecedores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50),
  `produto` VARCHAR(50),
  `CNPJ` INT(14),
  `telefone` VARCHAR(14),
  `email` VARCHAR(50),
  `ultima_remessa` DATE,
  `proxima_remessa` DATE,
  PRIMARY KEY (`id`));



CREATE TABLE IF NOT EXISTS `ultramixrh`.`contratos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_id` INT(11) NOT NULL,
  `duracao` VARCHAR(20),
  `produto_quantidade` VARCHAR(30),
  `valor` VARCHAR(20),
  PRIMARY KEY (`id`),
    FOREIGN KEY (`fornecedor_id`)
    REFERENCES `ultramixrh`.`fornecedores` (`id`));



CREATE TABLE IF NOT EXISTS `ultramixrh`.`folha_pagamento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `funcionario_id` INT(11) NOT NULL,
  `cargo_id` INT(11) NOT NULL,
  `salario_bruto` DOUBLE,
  `beneficios` INT(11),
  `bonus` INT(11),
  `valor_receber` INT(11),
  PRIMARY KEY (`id`),
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `ultramixrh`.`funcionarios` (`id`),
    FOREIGN KEY (`cargo_id`)
    REFERENCES `ultramixrh`.`cargos` (`id`));

CREATE TABLE IF NOT EXISTS `ultramixrh`.`folha_ponto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `funcionario_id` INT(11) NOT NULL,
  `horario_chegada` DATETIME,
  `horario_saida` DATETIME,
  `horas` TIME GENERATED ALWAYS AS (timediff(`horario_saida`,`horario_chegada`)) STORED,
  PRIMARY KEY (`id`),
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `ultramixrh`.`funcionarios` (`id`));


CREATE TABLE IF NOT EXISTS `ultramixrh`.`funcionario_cargo` (
  `funcionario_id` INT(11) NOT NULL,
  `cargo_titulo` VARCHAR(40) NOT NULL,
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `ultramixrh`.`funcionarios` (`id`),
    FOREIGN KEY (`cargo_titulo`)
    REFERENCES `ultramixrh`.`cargos` (`titulo`));
    
    ---TRIGGERS---
    
    DELIMITER //
    
    CREATE TRIGGER novo_funcionario_cargo
    AFTER INSERT ON funcionarios
    FOR EACH ROW 
    BEGIN
    INSERT INTO funcionario_cargo (funcionario_id, cargo_titulo)
    VALUES (new.id, new.cargo);
    END;
    //
    
    DELIMITER ;
    
    DELIMITER //
create trigger deletar_funcionario_cargo
before delete on funcionarios
for each row 
BEGIN
DELETE FROM funcionario_cargo WHERE funcionario_id = old.id;
END //

DELIMITER ;

DELIMITER //
CREATE TRIGGER trazer_salario
BEFORE INSERT ON folha_pagamento
FOR EACH ROW
BEGIN
DECLARE novosalario DECIMAL(10,2);
SELECT salario
INTO novosalario
FROM cargos
WHERE id = new.cargo_id;

SET NEW.salario_bruto = novosalario;
END//

DELIMITER ;

DELIMITER //
CREATE TRIGGER calc_valor_receber
BEFORE INSERT ON folha_pagamento
FOR EACH ROW
BEGIN
DECLARE valortotal decimal (10,2);
 SET valortotal = NEW.salario_bruto + NEW.beneficios + NEW.bonus;

SET new.valor_receber = valortotal;
 
END//

DELIMITER ;
-- INSERTS --

insert into cargos (titulo, carga_horaria, funcao, faixa_salarial) values ('Operador de Caixa', 8, 'Gere o caixa', '2.000 à 3.000');
insert into cargos (titulo, carga_horaria, funcao, faixa_salarial) values ('Repositor', 8, 'Repõe as mercadorias', '2.000 à 3.000');
insert into cargos (titulo, carga_horaria, funcao, faixa_salarial) values ('Empacotador', 8, 'Empacota as compras dos clientes', '1.600 à 2.600');
insert into cargos (titulo, carga_horaria, funcao, faixa_salarial) values ('Açougueiro', 8, 'Responsável pelo açougue', '2.500 à 3.800');
insert into cargos (titulo, carga_horaria, funcao, faixa_salarial) values ('Estoquista', 8, 'Responsável pelo estoque, o que vai para pratileiras e etc.', '2.600 a 3.700');
insert into cargos (titulo, carga_horaria, funcao, faixa_salarial) values ('Auxiliar Administrativo', 8, 'Responsável por negociar preços e garantir que o supermercado receba os produtos e serviços necessários.', '4.000 a 5.000');
