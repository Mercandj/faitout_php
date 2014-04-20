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
  `date_inscription` DATE NULL,
  `age` VARCHAR(100) NULL,
  `sexe` VARCHAR(100) NULL,
  `grade` VARCHAR(100) NULL,
  `Groupe_nom_cree` VARCHAR(100) NOT NULL,
  `Groupe_nom_inscrit` VARCHAR(100) NULL,
  PRIMARY KEY (`pseudo`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `Message`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Message` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `Message` (
  `date` DATE NOT NULL,
  `Utilisateur_pseudo` VARCHAR(100) NOT NULL,
  `message` VARCHAR(9999) NULL,
  PRIMARY KEY (`date`, `Utilisateur_pseudo`))
ENGINE = InnoDB;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
