ALTER TABLE `Utilisateur` ADD `date_de_connexion` DATETIME NULL
ALTER TABLE `Utilisateur` DROP COLUMN `date_inscription`

ALTER TABLE `Utilisateur` ADD `longitude` VARCHAR(80) NULL
ALTER TABLE `Utilisateur` ADD `latitude` VARCHAR(80) NULL