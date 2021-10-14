-- MySQL Script generated by MySQL Workbench
-- lun 01 jun 2020 13:27:58 -03
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gestorinventario
-- -----------------------------------------------------
-- Este sistema esta preparado para manejar la entrada y salida de productos
DROP SCHEMA IF EXISTS `gestorinventario` ;

-- -----------------------------------------------------
-- Schema gestorinventario
--
-- Este sistema esta preparado para manejar la entrada y salida de productos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestorinventario` DEFAULT CHARACTER SET utf8 ;
USE `gestorinventario` ;

-- -----------------------------------------------------
-- Table `gestorinventario`.`unidad_medida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`unidad_medida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `simbolo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorinventario`.`marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorinventario`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorinventario`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `unidad_valor` VARCHAR(4) NULL,
  `unidad_medidaid` INT NOT NULL,
  `marcaid` INT NOT NULL,
  `categoriaid` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  INDEX `fk_producto_unidad_medida_idx` (`unidad_medidaid` ASC),
  INDEX `fk_producto_marca1_idx` (`marcaid` ASC),
  INDEX `fk_producto_categoria1_idx` (`categoriaid` ASC),
  CONSTRAINT `fk_producto_unidad_medida`
    FOREIGN KEY (`unidad_medidaid`)
    REFERENCES `gestorinventario`.`unidad_medida` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_marca1`
    FOREIGN KEY (`marcaid`)
    REFERENCES `gestorinventario`.`marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_categoria1`
    FOREIGN KEY (`categoriaid`)
    REFERENCES `gestorinventario`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorinventario`.`proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`proveedor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `cuit` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorinventario`.`comprobante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`comprobante` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nro_remito` VARCHAR(45) NOT NULL,
  `fecha_incial` DATE NOT NULL COMMENT 'Fecha de registro en el servidor\n',
  `fecha_emision` DATE NOT NULL COMMENT 'fecha que se emite el comprobate\n',
  `total` VARCHAR(45) NULL,
  `proveedorid` INT NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nro_remito_UNIQUE` (`nro_remito` ASC),
  INDEX `fk_comprobante_proveedor1_idx` (`proveedorid` ASC),
  CONSTRAINT `fk_comprobante_proveedor1`
    FOREIGN KEY (`proveedorid`)
    REFERENCES `gestorinventario`.`proveedor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorinventario`.`egreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`egreso` (
  `id` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `origen` VARCHAR(100) NULL,
  `destino_nombre` VARCHAR(100) NOT NULL,
  `destino_localidadid` INT NOT NULL,
  `descripcion` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorinventario`.`deposito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`deposito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `lugarid` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestorinventario`.`inventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestorinventario`.`inventario` (
  `comprobanteid` INT NOT NULL,
  `productoid` INT NOT NULL,
  `fecha_vencimiento` DATE NULL,
  `precio_unitario` DOUBLE NULL DEFAULT 0,
  `defectuoso` TINYINT(1) NULL DEFAULT 0,
  `egresoid` INT NULL,
  `depositoid` INT NULL,
  `inexistente` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`comprobanteid`, `productoid`),
  INDEX `fk_comprobante_has_producto_producto1_idx` (`productoid` ASC),
  INDEX `fk_comprobante_has_producto_comprobante1_idx` (`comprobanteid` ASC),
  INDEX `fk_stock_egreso1_idx` (`egresoid` ASC),
  INDEX `fk_stock_deposito1_idx` (`depositoid` ASC),
  CONSTRAINT `fk_comprobante_has_producto_comprobante1`
    FOREIGN KEY (`comprobanteid`)
    REFERENCES `gestorinventario`.`comprobante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comprobante_has_producto_producto1`
    FOREIGN KEY (`productoid`)
    REFERENCES `gestorinventario`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_egreso1`
    FOREIGN KEY (`egresoid`)
    REFERENCES `gestorinventario`.`egreso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_deposito1`
    FOREIGN KEY (`depositoid`)
    REFERENCES `gestorinventario`.`deposito` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
