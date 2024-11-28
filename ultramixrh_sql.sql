-- DROP SCHEMA `ultramixrh` ;

CREATE SCHEMA IF NOT EXISTS `ultramixrh` DEFAULT CHARACTER SET utf8mb4 ;
USE `ultramixrh` ;

create table if not exists login (id int not null auto_increment primary key, usuario varchar(50), senha varchar(255));


CREATE TABLE IF NOT EXISTS funcionarios (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nome VARCHAR(50),
  `cargo` VARCHAR(40),
  `CPF` INTEGER,
  `data_admissão` DATE,
  `telefone` VARCHAR(14),
  `email` VARCHAR(50),
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS avaliacoes(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `funcionario_id` INT(11) NOT NULL,
  `produtividade` INTEGER,
  `empenho` INTEGER,
  `relatorio` VARCHAR(100),
  `recomenda_promoção` VARCHAR(20),
  PRIMARY KEY (`id`),
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `ultramixrh`.`funcionarios` (`id`));

CREATE TABLE IF NOT EXISTS `ultramixrh`.`banco_horas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `funcionario_id` INT(11) NOT NULL,
  `horas_em_banco` INTEGER,
  `ferias` VARCHAR(40),
  `licencas` VARCHAR(40),
  PRIMARY KEY (`id`),
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `ultramixrh`.`funcionarios` (`id`));


CREATE TABLE IF NOT EXISTS `ultramixrh`.`cargos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(40) UNIQUE,
  `carga_horaria` INTEGER,
  `funcao` VARCHAR(300),
  `salario` DOUBLE(10,3),
  PRIMARY KEY (`id`));


CREATE TABLE IF NOT EXISTS `ultramixrh`.`fornecedores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50),
  `produto` VARCHAR(50),
  `CNPJ` INTEGER,
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
  `cargo` VARCHAR(40),
  `salario_bruto` DOUBLE(10,3),
  `beneficios` DOUBLE,
  `bonus` DOUBLE,
  `valor_receber` DOUBLE(10,3),
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
CREATE TRIGGER trazer_cargo
BEFORE INSERT ON folha_pagamento
FOR EACH ROW
BEGIN
DECLARE novocargo VARCHAR(40);
SELECT titulo
INTO novocargo
FROM cargos
WHERE id = new.cargo_id;

SET NEW.cargo = novocargo;
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

insert into cargos (titulo, carga_horaria, funcao, salario) values ('Operador de Caixa', 8, 'Gere o caixa', 2.000);
insert into cargos (titulo, carga_horaria, funcao, salario) values ('Repositor', 8, 'Repõe as mercadorias', 2.000);
insert into cargos (titulo, carga_horaria, funcao, salario) values ('Empacotador', 8, 'Empacota as compras dos clientes', 1.600);
insert into cargos (titulo, carga_horaria, funcao, salario) values ('Açougueiro', 8, 'Responsável pelo açougue', 2.500);
insert into cargos (titulo, carga_horaria, funcao, salario) values ('Estoquista', 8, 'Responsável pelo estoque, o que vai para pratileiras e etc.', 2.600);
insert into cargos (titulo, carga_horaria, funcao, salario) values ('Auxiliar Administrativo', 8, 'Responsável por negociar preços e garantir que o supermercado receba os produtos e serviços necessários.', 4.000);

insert into funcionarios (nome, cargo, cpf, data_admissão, telefone, email) values ('Bruno Sales', 'Estoquista', 0738655412, '2023-04-03', '4002892274', 'emaildobruno@gmail.com');
insert into funcionarios (nome, cargo, cpf, data_admissão, telefone, email) values ('Ruben Amorim', 'Açougueiro', 586036200, '2022-12-04', '5894213597', 'emaildoruben@gmail.com');
insert into funcionarios (nome, cargo, cpf, data_admissão, telefone, email) values ('Junior Belgrano', 'Operador de Caixa', 679548265, '2024-05-06', '8492547926', 'emaildojunior@gmail.com');
insert into funcionarios (nome, cargo, cpf, data_admissão, telefone, email) values ('Ederson Costa', 'Empacotador', 657915487, '2024-01-03', '6498761397', 'emaildoederson@gmail.com');
insert into funcionarios (nome, cargo, cpf, data_admissão, telefone, email) values ('Maurício Sousa', 'Auxiliar Administrativo', 461297831, '2023-09-06', '4877261459', 'emaildomauricio@gmail.com');
insert into funcionarios (nome, cargo, cpf, data_admissão, telefone, email) values ('Larissa Carvalho', 'Estoquista', 297435431, '2023-04-30', '7892462481', 'emaildalarissa@gmail.com');
insert into funcionarios (nome, cargo, cpf, data_admissão, telefone, email) values ('Dandara Silva', 'Auxiliar Administrativo', 197346732, '2022-11-24', '4246386565', 'emaildandara@gmail.com');
insert into funcionarios (nome, cargo, cpf, data_admissão, telefone, email) values ('Cássio Reis', 'Repositor', 359554244, '2024-10-05', '7432158996', 'emaildocassio@gmail.com');

insert into fornecedores (nome, produto, CNPJ, telefone, email, ultima_remessa, proxima_remessa) values ('Sabor Sul', 'Arroz Branco', 547184498, 4248187762, 'saborsul@gmail.com', '2024-11-04', '2024-12-04');
insert into fornecedores (nome, produto, CNPJ, telefone, email, ultima_remessa, proxima_remessa) values ('Kicaldo', 'Feijão Carioca', 546921658, 2165482234, 'kicaldo@gmail.com', '2024-11-04', '2024-12-04');
insert into fornecedores (nome, produto, CNPJ, telefone, email, ultima_remessa, proxima_remessa) values ('Delícia', 'Margarina', 54876215, 6542159483 , 'delicia@gmail.com', '2024-11-10', '2024-12-05');
insert into fornecedores (nome, produto, CNPJ, telefone, email, ultima_remessa, proxima_remessa) values ('Omo', 'Sabão em pó', 45106089, 4932018284, 'omo@gmail.com', '2024-11-02', '2024-12-12');
insert into fornecedores (nome, produto, CNPJ, telefone, email, ultima_remessa, proxima_remessa) values ('Kelloggs', 'Sucrilhos', 08064354, 0408947349, 'kelloggs@gmail.com', '2024-11-02', '2024-12-12');

insert into avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values ( 1, 5, 7, 'É competente mas desmotivado', 'Não');
insert into avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values ( 2, 6, 6, 'Mediano', 'Não');
insert into avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values ( 3, 2, 5, 'Muito desatento', 'Não');
insert into avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values ( 4, 7, 8, 'Muito consistente e prestativo, porém novo', 'Não');
insert into avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values ( 5, 7, 7, 'Está indo bem, mas tem que manter a forma', 'Não');
insert into avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values ( 6, 4, 7, 'Está insatisfeita com o trabalho', 'Não');
insert into avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values ( 7, 7, 6, 'Bom, mas ainda novo', 'Não');
insert into avaliacoes (funcionario_id, produtividade, empenho, relatorio, recomenda_promoção) values ( 8, 7, 8, 'Experiente, dedicado e já se mostrou capaz de gerir', 'Sim');

insert into contratos (fornecedor_id, duracao, produto_quantidade, valor) values ( 1, '1 ano', '600 mensais', 'R$45.000');
insert into contratos (fornecedor_id, duracao, produto_quantidade, valor) values ( 2, '3 anos', '800 mensais', 'R$55.000');
insert into contratos (fornecedor_id, duracao, produto_quantidade, valor) values ( 3, '2 anos', '350 mensais', 'R$20.000');
insert into contratos (fornecedor_id, duracao, produto_quantidade, valor) values ( 4, '2 anos', '165 mensais', 'R$20.000');
insert into contratos (fornecedor_id, duracao, produto_quantidade, valor) values ( 5, '1 ano', '80 mensais', 'R$19.000');

insert into banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (1, 2, '46 horas debitadas de férias', 'Nenhuma');
insert into banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (2, 16, 'Nenhuma', '29 horas debitadas por questões de saúde');
insert into banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (3, 9, '23 horas debitadas de férias', '12 horas debitadas por questões pessoais');
insert into banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (4, 52, 'Nenhuma', 'Nenhuma');
insert into banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (5, 30, '21 horas debitadas de férias', 'Nenhuma');
insert into banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (6, 26, '26 horas debitadas de férias', 'Nenhuma');
insert into banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (7, 28, 'Nenhuma', '27 horas por questões pessoais');
insert into banco_horas (funcionario_id, horas_em_banco, ferias, licencas) values (8, 66, 'Nenhuma', 'Nenhuma');

insert into folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values(1, 5, 0.300, 0);
insert into folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values (2, 4, 0.300, 0.100);
insert into folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values (3, 1, 0.300, 0.50);
insert into folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values (4, 3, 0.300, 0);
insert into folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values (5, 6, 0.500, 0.200);
insert into folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values (6, 5, 0.300, 0.100);
insert into folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values (7, 6, 0.300, 0.200);
insert into folha_pagamento (funcionario_id, cargo_id, beneficios, bonus) values (8, 2, 0.300, 0.100);

insert into folha_ponto (funcionario_id, horario_chegada, horario_saida) values(1, now(), DATE_SUB(NOW(), INTERVAL 8 HOUR));
insert into folha_ponto (funcionario_id, horario_chegada, horario_saida) values(1, DATE_SUB(NOW(), INTERVAL 16 HOUR), DATE_SUB(NOW(), INTERVAL 8 HOUR));
insert into folha_ponto (funcionario_id, horario_chegada, horario_saida) values(1, DATE_SUB(NOW(), INTERVAL 16 HOUR), DATE_SUB(NOW(), INTERVAL 8 HOUR));
insert into folha_ponto (funcionario_id, horario_chegada, horario_saida) values(1, DATE_SUB(NOW(), INTERVAL 46 HOUR), DATE_SUB(NOW(), INTERVAL 8 HOUR));
insert into folha_ponto (funcionario_id, horario_chegada, horario_saida) values(1, DATE_SUB(NOW(), INTERVAL 35 HOUR), DATE_SUB(NOW(), INTERVAL 8 HOUR));
insert into folha_ponto (funcionario_id, horario_chegada, horario_saida) values(1, DATE_SUB(NOW(), INTERVAL 17 HOUR), DATE_SUB(NOW(), INTERVAL 8 HOUR));
insert into folha_ponto (funcionario_id, horario_chegada, horario_saida) values(1, DATE_SUB(NOW(), INTERVAL 97 HOUR), DATE_SUB(NOW(), INTERVAL 8 HOUR));
insert into folha_ponto (funcionario_id, horario_chegada, horario_saida) values(1, DATE_SUB(NOW(), INTERVAL 26 HOUR), DATE_SUB(NOW(), INTERVAL 8 HOUR));
