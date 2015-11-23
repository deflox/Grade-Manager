-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema grades
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema grades
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `grades` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `grades` ;

-- -----------------------------------------------------
-- Table `grades`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grades`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_firstname` VARCHAR(45) NOT NULL,
  `user_lastname` VARCHAR(45) NOT NULL,
  `user_email` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(255) NOT NULL,
  `user_rights` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`user_id`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grades`.`semesters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grades`.`semesters` (
  `semester_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `semester_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`semester_id`),
  INDEX `fk_semesters_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_semesters_users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `grades`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grades`.`subjects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grades`.`subjects` (
  `subject_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `semester_id` INT NOT NULL,
  `subject_counting` DECIMAL(4,2) NOT NULL,
  `subject_counts_to_average` INT NOT NULL,
  `subject_name` VARCHAR(45) NULL,
  PRIMARY KEY (`subject_id`),
  INDEX `fk_subjects_semesters1_idx` (`semester_id` ASC),
  INDEX `fk_subjects_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_subjects_semesters1`
  FOREIGN KEY (`semester_id`)
  REFERENCES `grades`.`semesters` (`semester_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subjects_users1`
  FOREIGN KEY (`user_id`)
  REFERENCES `grades`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grades`.`grades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grades`.`grades` (
  `grade_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  `grade_value` DECIMAL(4,2) NOT NULL,
  `grade_counting` DECIMAL(4,2) NOT NULL,
  `grade_date` TIMESTAMP NULL,
  `grade_name` VARCHAR(45) NOT NULL,
  `grade_description` VARCHAR(250) NULL,
  PRIMARY KEY (`grade_id`),
  INDEX `fk_grades_users_idx` (`user_id` ASC),
  INDEX `fk_grades_subjects1_idx` (`subject_id` ASC),
  CONSTRAINT `fk_grades_users`
  FOREIGN KEY (`user_id`)
  REFERENCES `grades`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_grades_subjects1`
  FOREIGN KEY (`subject_id`)
  REFERENCES `grades`.`subjects` (`subject_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
