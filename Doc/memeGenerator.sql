-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema memeGenerator
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema memeGenerator
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `memeGenerator` DEFAULT CHARACTER SET utf8 ;
USE `memeGenerator` ;

-- -----------------------------------------------------
-- Table `memeGenerator`.`meme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `memeGenerator`.`meme` (
  `mem_id` INT NOT NULL AUTO_INCREMENT,
  `mem_pseudo` VARCHAR(255) NOT NULL,
  `mem_image` LONGTEXT NOT NULL,
  `mem_createdAt` DATE NOT NULL,
  PRIMARY KEY (`mem_id`),
  UNIQUE INDEX `mem_id_UNIQUE` (`mem_id` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
