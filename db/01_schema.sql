-- -----------------------------------------------------
-- BASE DE DONÉES TOUCHE PAS AU KLAXON
-- Script de création du schéma et de l'utilisateur
-- -----------------------------------------------------
-- Description : Création de la base de données pour l'application Touche pas au kaxon
--               incluant les tables, contraintes et utilisateur d'administration.
--               La majeur partie du code a été générée par le programme MySQL Workbench.
-- -----------------------------------------------------

-- -----------------------------------------------------
-- SAUVEGARDE DES PARAMÈTRES MYSQL
-- -----------------------------------------------------
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- -----------------------------------------------------
-- CRÉATION DE LA BASE DE DONNÉES
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `TouchePasAuKlaxon` ;
CREATE SCHEMA IF NOT EXISTS `TouchePasAuKlaxon` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `TouchePasAuKlaxon` ;

-- -----------------------------------------------------
-- CRÉATION DE L'UTILISATEUR TPAK
-- -----------------------------------------------------
DROP USER IF EXISTS 'tpak'@'localhost';
CREATE USER 'tpak'@'localhost' IDENTIFIED BY 'Tpak2025!';
GRANT ALL PRIVILEGES ON `TouchePasAuKlaxon`.* TO 'tpak'@'localhost';
FLUSH PRIVILEGES;

-- -----------------------------------------------------
-- CRÉATION DES TABLES
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `TouchePasAuKlaxon`.`agences`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TouchePasAuKlaxon`.`agences` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ville` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `ville_UNIQUE` (`ville` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `TouchePasAuKlaxon`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TouchePasAuKlaxon`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(100) NOT NULL,
  `prenom` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(10) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `TouchePasAuKlaxon`.`trajets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TouchePasAuKlaxon`.`trajets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `agence_depart_id` INT NOT NULL,
  `agence_arrivee_id` INT NOT NULL,
  `date_heure_depart` DATETIME NOT NULL,
  `date_heure_arrivee` DATETIME NOT NULL,
  `places` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_trajet_user_idx` (`user_id` ASC) VISIBLE,
  INDEX `fk_trajet_depart_idx` (`agence_depart_id` ASC) VISIBLE,
  INDEX `fk_trajet_arrivee_idx` (`agence_arrivee_id` ASC) VISIBLE,
  CONSTRAINT `fk_trajet_arrivee`
    FOREIGN KEY (`agence_arrivee_id`)
    REFERENCES `TouchePasAuKlaxon`.`agences` (`id`)
    ON DELETE RESTRICT,
  CONSTRAINT `fk_trajet_depart`
    FOREIGN KEY (`agence_depart_id`)
    REFERENCES `TouchePasAuKlaxon`.`agences` (`id`)
    ON DELETE RESTRICT,
  CONSTRAINT `fk_trajet_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `TouchePasAuKlaxon`.`users` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `check_agences_diff` 
    CHECK (`agence_depart_id` != `agence_arrivee_id`),
  CONSTRAINT `check_dates` 
    CHECK (`date_heure_arrivee` > `date_heure_depart`)
) ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;

-- -----------------------------------------------------
-- RESTAURATION DES PARAMÈTRE MYSQL
-- -----------------------------------------------------
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
