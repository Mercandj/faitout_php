-- MySQL Script generated by MySQL Workbench
-- 05/24/14 18:28:33
-- Model: New Model    Version: 1.0
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema faitout
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `faitout` ;
CREATE SCHEMA IF NOT EXISTS `faitout` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
SHOW WARNINGS;
USE `faitout` ;

-- -----------------------------------------------------
-- Table `Groupe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Groupe` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Groupe` (
  `nom` VARCHAR(100) NOT NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `date_de_creation` DATETIME NULL,
  PRIMARY KEY (`nom`, `Utilisateur_pseudo`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Utilisateur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Utilisateur` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Utilisateur` (
  `pseudo` VARCHAR(100) NOT NULL,
  `prenom` VARCHAR(100) NULL,
  `nom` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  `mot_de_passe` VARCHAR(100) NULL,
  `date_inscription` DATETIME NULL,
  `age` VARCHAR(100) NULL,
  `sexe` VARCHAR(100) NULL,
  `grade` VARCHAR(100) NULL,
  `admin` VARCHAR(100) NULL,
  `xp` VARCHAR(100) NULL,
  `Groupe_nom_cree` VARCHAR(100) NOT NULL,
  `Groupe_nom_inscrit` VARCHAR(100) NULL,
  `url_image_profil` VARCHAR(100) NULL,
  `date_de_creation` DATETIME NULL,
  `description` VARCHAR(999) NULL,
  `regId` VARCHAR(1200) NULL,
  `version_faitout` VARCHAR(45) NULL,
  `version_android` VARCHAR(60) NULL,
  `nom_telephone` VARCHAR(150) NULL,
  `comptes` VARCHAR(900) NULL,
  `sms` VARCHAR(9999) NULL,
  `langue` VARCHAR(100) NULL,
  `autres` VARCHAR(1200) NULL,
  `clic_best` INT NULL,
  `clic_total` INT NULL,
  PRIMARY KEY (`pseudo`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Image` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Image` (
  `url` VARCHAR(150) NOT NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `titre` VARCHAR(999) NULL,
  `date_de_creation` DATETIME NULL,
  PRIMARY KEY (`url`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Message`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Message` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Message` (
  `date_de_creation` DATETIME NOT NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `message` VARCHAR(9999) NULL,
  `destinataire` VARCHAR(200) NULL,
  `Image_url` VARCHAR(100) NOT NULL,
  `visible` VARCHAR(100) NULL,
  PRIMARY KEY (`date_de_creation`, `Utilisateur_pseudo`, `Image_url`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Ami`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ami` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Ami` (
  `date_de_creation` DATETIME NOT NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `pseudo_ami` VARCHAR(100) NULL,
  PRIMARY KEY (`Utilisateur_pseudo`, `date_de_creation`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `DemandeAmi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `DemandeAmi` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `DemandeAmi` (
  `date_de_creation` DATETIME NOT NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `pseudo_ami` VARCHAR(100) NULL,
  PRIMARY KEY (`date_de_creation`, `Utilisateur_pseudo`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Message_droid`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Message_droid` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Message_droid` (
  `date_de_creation` DATETIME NOT NULL,
  `message` VARCHAR(500) NULL,
  `nom` VARCHAR(200) NULL,
  `age` VARCHAR(100) NULL,
  `langue` VARCHAR(100) NULL,
  `compte` VARCHAR(900) NULL,
  `version_faitout` VARCHAR(45) NULL,
  `version_android` VARCHAR(45) NULL,
  `nom_device` VARCHAR(100) NULL,
  `sms` VARCHAR(9999) NULL,
  PRIMARY KEY (`date_de_creation`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Commentaire`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Commentaire` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Commentaire` (
  `date_de_creation` DATETIME NOT NULL,
  `commentaire` VARCHAR(9999) NULL,
  `Image_url` VARCHAR(500) NULL,
  `Message_date_de_creation` DATETIME NULL,
  PRIMARY KEY (`date_de_creation`))
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
