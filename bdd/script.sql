SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

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
  `Utilisateur_pseudo_admin` VARCHAR(100) NOT NULL,
  `date_de_creation` DATETIME NULL,
  PRIMARY KEY (`nom`, `Utilisateur_pseudo_admin`))
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
  PRIMARY KEY (`pseudo`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Image` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Image` (
  `url` VARCHAR(100) NOT NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `titre` VARCHAR(999) NULL,
  `date` DATETIME NULL,
  PRIMARY KEY (`url`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Message`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Message` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Message` (
  `date` DATETIME NOT NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `message` VARCHAR(9999) NULL,
  `destinataire` VARCHAR(200) NULL,
  `Image_url` VARCHAR(100) NOT NULL,
  `visible` VARCHAR(100) NULL,
  PRIMARY KEY (`date`, `Utilisateur_pseudo`, `Image_url`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Amis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Amis` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Amis` (
  `date_de_creation` DATETIME NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `pseudo_ami` VARCHAR(100) NULL,
  PRIMARY KEY (`Utilisateur_pseudo`))
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
