ALTER TABLE `facturar_opciones` ADD `dx0` VARCHAR(5) NOT NULL COMMENT 'Comanda' AFTER `cx1`, 
ADD `dx1` VARCHAR(5) NOT NULL COMMENT 'Comanda' AFTER `dx0`, 
ADD `ex0` VARCHAR(5) NOT NULL COMMENT 'Credito Fiscal' AFTER `dx1`, 
ADD `ex1` VARCHAR(5) NOT NULL COMMENT 'Credito Fiscal' AFTER `ex0`, 
ADD `nota_credito` INT(2) NOT NULL AFTER `ex1`, 
ADD `abono` INT(2) NOT NULL AFTER `nota_credito`, 
ADD `predeterminado` INT(2) NOT NULL AFTER `abono`;


ALTER TABLE `facturar_documento` ADD `giro` VARCHAR(200) NOT NULL AFTER `cliente`, 
ADD `registro` VARCHAR(100) NOT NULL AFTER `giro`, 
ADD `direccion` VARCHAR(200) NOT NULL AFTER `registro`, 
ADD `departamento` VARCHAR(100) NOT NULL AFTER `direccion`;

ALTER TABLE `ticket_num` ADD `tipo` INT(1) NOT NULL COMMENT '0 ninguno, 1 ticket, 2 factura, 3 crédito fiscal, 4 nota de credito' AFTER `tx`;