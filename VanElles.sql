-- MySQL Script generated by MySQL Workbench
-- 11/23/17 16:14:27
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
-- -----------------------------------------------------
-- Schema new_schema1
-- -----------------------------------------------------
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`review` (
  `review_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `user_id` VARCHAR(45) NOT NULL COMMENT '',
  `review_name` VARCHAR(45) NULL COMMENT '',
  `title` VARCHAR(45) NULL COMMENT '',
  `omschijving` VARCHAR(2000) NULL COMMENT '',
  `rating` INT(1) NULL COMMENT '',
  PRIMARY KEY (`review_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`role` (
  `role` INT NOT NULL COMMENT '',
  `role_name` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`role`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user_id`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user_id` (
  `blog_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `blog_name` VARCHAR(45) NOT NULL COMMENT '',
  `blog_date` DATE NOT NULL COMMENT '',
  `blog_data` VARCHAR(2000) NOT NULL COMMENT '',
  `foto` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`blog_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`admin` (
  `user_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `wachtwoord` CHAR(128) NOT NULL COMMENT '',
  `salt` VARCHAR(45) NOT NULL COMMENT '',
  `hash` VARCHAR(45) NOT NULL COMMENT '',
  `username` VARCHAR(45) NOT NULL COMMENT '',
  `blog_blog_id` INT NULL COMMENT '',
  `blog_admin_id` INT NULL COMMENT '',
  PRIMARY KEY (`user_id`)  COMMENT '',
  INDEX `fk_admin_blog1_idx` (`blog_blog_id` ASC, `blog_admin_id` ASC)  COMMENT '',
  CONSTRAINT `fk_admin_blog1`
    FOREIGN KEY (`blog_blog_id`)
    REFERENCES `mydb`.`user_id` (`blog_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`contact`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`contact` (
  `contact_id` INT NOT NULL COMMENT '',
  `user_id` VARCHAR(45) NULL COMMENT '',
  `contact_data` VARCHAR(45) NULL COMMENT '',
  `contact_date` TIMESTAMP(6) NULL COMMENT '',
  PRIMARY KEY (`contact_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `email` VARCHAR(45) NOT NULL COMMENT '',
  `role` INT NOT NULL DEFAULT 2 COMMENT '',
  `first_name` VARCHAR(45) NULL COMMENT '',
  `insertion` VARCHAR(45) NULL COMMENT '',
  `last_name` VARCHAR(45) NULL COMMENT '',
  `phonenumber` INT(12) NULL COMMENT '',
  `city` VARCHAR(45) NULL COMMENT '',
  `address` VARCHAR(45) NULL COMMENT '',
  `zipcode` VARCHAR(45) NULL COMMENT '',
  `review_review_id` INT NULL COMMENT '',
  `role_role` INT NULL COMMENT '',
  `admin_user_id` INT NULL COMMENT '',
  `contact_contact_id` INT NULL COMMENT '',
  PRIMARY KEY (`user_id`)  COMMENT '',
  INDEX `fk_user_review1_idx` (`review_review_id` ASC)  COMMENT '',
  INDEX `fk_user_role1_idx` (`role_role` ASC)  COMMENT '',
  INDEX `fk_user_admin1_idx` (`admin_user_id` ASC)  COMMENT '',
  INDEX `fk_user_contact1_idx` (`contact_contact_id` ASC)  COMMENT '',
  CONSTRAINT `fk_user_review1`
    FOREIGN KEY (`review_review_id`)
    REFERENCES `mydb`.`review` (`review_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role1`
    FOREIGN KEY (`role_role`)
    REFERENCES `mydb`.`role` (`role`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_admin1`
    FOREIGN KEY (`admin_user_id`)
    REFERENCES `mydb`.`admin` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_contact1`
    FOREIGN KEY (`contact_contact_id`)
    REFERENCES `mydb`.`contact` (`contact_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`workshop_id`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`workshop_id` (
  `workshop_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `user_id` INT NOT NULL COMMENT '',
  `user_user_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`workshop_id`)  COMMENT '',
  INDEX `fk_workshop_id_user1_idx` (`user_user_id` ASC)  COMMENT '',
  CONSTRAINT `fk_workshop_id_user1`
    FOREIGN KEY (`user_user_id`)
    REFERENCES `mydb`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`workshop`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`workshop` (
  `workshop_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `workshop_name` VARCHAR(45) NOT NULL COMMENT '',
  `workshop_date` DATETIME NOT NULL COMMENT '',
  `workshop_max` INT NULL COMMENT '',
  `workshop_id_workshop_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`workshop_id`)  COMMENT '',
  INDEX `fk_workshop_workshop_id1_idx` (`workshop_id_workshop_id` ASC)  COMMENT '',
  CONSTRAINT `fk_workshop_workshop_id1`
    FOREIGN KEY (`workshop_id_workshop_id`)
    REFERENCES `mydb`.`workshop_id` (`workshop_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`leveranciers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`leveranciers` (
  `leveranciers_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `leveranciers_naam` VARCHAR(45) NULL COMMENT '',
  `leveranciers_logo` VARCHAR(45) NULL COMMENT '',
  `admin_user_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`leveranciers_id`)  COMMENT '',
  INDEX `fk_leveranciers_admin1_idx` (`admin_user_id` ASC)  COMMENT '',
  CONSTRAINT `fk_leveranciers_admin1`
    FOREIGN KEY (`admin_user_id`)
    REFERENCES `mydb`.`admin` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`product` (
  `product_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `leveranciers_id` VARCHAR(45) NOT NULL COMMENT '',
  `product_prijs` VARCHAR(45) NOT NULL COMMENT '',
  `product_naam` VARCHAR(45) NOT NULL COMMENT '',
  `leveranciers_leveranciers_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`product_id`, `leveranciers_id`)  COMMENT '',
  INDEX `fk_product_leveranciers1_idx` (`leveranciers_leveranciers_id` ASC)  COMMENT '',
  CONSTRAINT `fk_product_leveranciers1`
    FOREIGN KEY (`leveranciers_leveranciers_id`)
    REFERENCES `mydb`.`leveranciers` (`leveranciers_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
