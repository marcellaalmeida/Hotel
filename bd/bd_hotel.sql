-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bd_hotel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd_hotel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd_hotel` DEFAULT CHARACTER SET utf8 ;
USE `bd_hotel` ;

-- -----------------------------------------------------
-- Table `bd_hotel`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_hotel`.`funcionario` (
  `id_funcionario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `cargo` VARCHAR(45) NULL,
  `salario` DOUBLE NULL,
  PRIMARY KEY (`id_funcionario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_hotel`.`gerente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_hotel`.`gerente` (
  `id_gerente` INT NOT NULL AUTO_INCREMENT,
  `nivel_acesso` VARCHAR(45) NULL,
  `funcionario_id_funcionario` INT NOT NULL,
  PRIMARY KEY (`id_gerente`),
  INDEX `fk_gerente_funcionario1_idx` (`funcionario_id_funcionario` ASC) VISIBLE,
  CONSTRAINT `fk_gerente_funcionario1`
    FOREIGN KEY (`funcionario_id_funcionario`)
    REFERENCES `bd_hotel`.`funcionario` (`id_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_hotel`.`hospede`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_hotel`.`hospede` (
  `id_hospede` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `cpf` VARCHAR(14) NULL,
  `cep` VARCHAR(45) NULL,
  `numero` VARCHAR(45) NULL,
  PRIMARY KEY (`id_hospede`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_hotel`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_hotel`.`status` (
  `idstatus` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`idstatus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_hotel`.`tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_hotel`.`tipo` (
  `idtipo` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`idtipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_hotel`.`quarto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_hotel`.`quarto` (
  `idquarto` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NULL,
  `preco_diaria` FLOAT NULL,
  `status_idstatus` INT NOT NULL,
  `tipo_idtipo` INT NOT NULL,
  PRIMARY KEY (`idquarto`),
  INDEX `fk_quarto_status1_idx` (`status_idstatus` ASC) VISIBLE,
  INDEX `fk_quarto_tipo1_idx` (`tipo_idtipo` ASC) VISIBLE,
  CONSTRAINT `fk_quarto_status1`
    FOREIGN KEY (`status_idstatus`)
    REFERENCES `bd_hotel`.`status` (`idstatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_quarto_tipo1`
    FOREIGN KEY (`tipo_idtipo`)
    REFERENCES `bd_hotel`.`tipo` (`idtipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_hotel`.`status_reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_hotel`.`status_reserva` (
  `idstatus_reserva` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) NULL,
  PRIMARY KEY (`idstatus_reserva`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_hotel`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_hotel`.`reserva` (
  `id_reserva` INT NOT NULL AUTO_INCREMENT,
  `data_checkin` DATE NULL,
  `data_checkout` DATE NULL,
  `valor_total` DOUBLE NULL,
  `funcionario_id_funcionario` INT NOT NULL,
  `hospede_id_hospede` INT NOT NULL,
  `quarto_idquarto` INT NOT NULL,
  `status_reserva_idstatus_reserva` INT NOT NULL,
  PRIMARY KEY (`id_reserva`),
  INDEX `fk_reserva_funcionario_idx` (`funcionario_id_funcionario` ASC) VISIBLE,
  INDEX `fk_reserva_hospede1_idx` (`hospede_id_hospede` ASC) VISIBLE,
  INDEX `fk_reserva_quarto1_idx` (`quarto_idquarto` ASC) VISIBLE,
  INDEX `fk_reserva_status_reserva1_idx` (`status_reserva_idstatus_reserva` ASC) VISIBLE,
  CONSTRAINT `fk_reserva_funcionario`
    FOREIGN KEY (`funcionario_id_funcionario`)
    REFERENCES `bd_hotel`.`funcionario` (`id_funcionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_hospede1`
    FOREIGN KEY (`hospede_id_hospede`)
    REFERENCES `bd_hotel`.`hospede` (`id_hospede`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_quarto1`
    FOREIGN KEY (`quarto_idquarto`)
    REFERENCES `bd_hotel`.`quarto` (`idquarto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_status_reserva1`
    FOREIGN KEY (`status_reserva_idstatus_reserva`)
    REFERENCES `bd_hotel`.`status_reserva` (`idstatus_reserva`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;