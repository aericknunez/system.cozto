
ALTER TABLE `ticket` ADD `pc` FLOAT(10,4) NOT NULL AFTER `producto`;

ALTER TABLE `gastos` ADD `no_factura` VARCHAR(25) NOT NULL AFTER `edo`, ADD `tipo_pago` INT(5) NOT NULL AFTER `no_factura`, ADD `cuenta_banco` VARCHAR(12) NOT NULL AFTER `tipo_pago`, ADD `categoria` VARCHAR(12) NOT NULL AFTER `cuenta_banco`;
ALTER TABLE `gastos` ADD `tipo_comprobante` INT(2) NOT NULL AFTER `edo`;


UPDATE `gastos` SET `tipo_pago`= 1  WHERE tipo != 5;

UPDATE `ticket` SET `pc`= (SELECT precio_costo FROM producto_ingresado WHERE producto_ingresado.producto = ticket.cod AND producto_ingresado.td = ticket.td LIMIT 1) WHERE pc = 0;

CREATE TABLE `gastos_categorias` (
  `id` int(6) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `edo` int(2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `gastos_categorias`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `gastos_categorias`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
  


CREATE TABLE `gastos_cuentas` (
  `id` int(6) NOT NULL,
  `tipo` int(2) NOT NULL COMMENT '2 chequera, 3 cuenta, 4 tarjeta credito',
  `cuenta` varchar(50) NOT NULL,
  `banco` varchar(50) NOT NULL,
  `saldo` float(10,4) NOT NULL,
  `edo` int(2) NOT NULL COMMENT '1 activo 2 inactivo',
  `td` int(6) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `gastos_cuentas`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `gastos_cuentas`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
  
  
  
  
  
  
  
  CREATE TABLE `ajuste_inventario` (
  `id` int(6) NOT NULL,
  `cod` varchar(50) NOT NULL,
  `cantidad` float(10,4) NOT NULL,
  `establecido` float(10,4) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `ajuste_inventario_activate` (
  `id` int(6) NOT NULL,
  `edo` int(1) NOT NULL,
  `inicio` int(12) NOT NULL,
  `fin` int(12) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `ajuste_inventario`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `ajuste_inventario_activate`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `ajuste_inventario`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ajuste_inventario_activate`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;