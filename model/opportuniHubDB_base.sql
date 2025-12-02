-- Se crea la base de datos
DROP DATABASE IF EXISTS opportuniHubDB;
CREATE DATABASE opportuniHubDB;
USE opportuniHubDB;

-- Tabla para los diferentes roles
CREATE TABLE roles (
  roleID            INT         NOT NULL AUTO_INCREMENT,
  roleName          VARCHAR(15) NOT NULL,
  PRIMARY KEY (roleID)
);

-- Tabla para el user (contribuidor y administrador)
CREATE TABLE users (
  userID        VARCHAR(50)    NOT NULL,
  email         VARCHAR(100)   NOT NULL UNIQUE,
  password      VARCHAR(255)   NOT NULL,
  userRole      INT            NOT NULL,
  PRIMARY KEY (userID),
  CONSTRAINT fk_user_role
    FOREIGN KEY (userRole) REFERENCES roles (roleID)
);

-- Tabla para las diferentes oportunidades disponibles
CREATE TABLE opportunities_type (
  typeID           INT          NOT NULL AUTO_INCREMENT,
  typeName         VARCHAR(30)  NOT NULL,
  PRIMARY KEY (typeID)
);

-- Tabla para las oportunidades
CREATE TABLE opportunities (
  oppID           INT            NOT NULL AUTO_INCREMENT,
  oppType         INT            NOT NULL,
  ownerUserID     VARCHAR(50)    NOT NULL,
  title           VARCHAR(200)   NOT NULL,
  description     TEXT           NOT NULL,
  sponsor         VARCHAR(100)   NOT NULL,
  url             VARCHAR(255)   DEFAULT NULL,
  attachmentPath  VARCHAR(100)   DEFAULT NULL,
  deadline        DATE           DEFAULT NULL,
  datePosted      DATE           NOT NULL  DEFAULT CURRENT_DATE,

  PRIMARY KEY (oppID),
  INDEX ownerUserID (ownerUserID),
  CONSTRAINT fk_opp_type
    FOREIGN KEY (oppType) REFERENCES opportunities_type(typeID),
  CONSTRAINT fk_opp_user
    FOREIGN KEY (ownerUserID) REFERENCES users(userID) 
      ON DELETE CASCADE 
      ON UPDATE CASCADE
);

-- Tabla para la lista de distribucion de email
CREATE TABLE distribution_list (
  email     VARCHAR(100) NOT NULL,
  PRIMARY KEY (email)
);

-- Se añaden las oportunidades que estaran disponibles
INSERT INTO opportunities_type (typeName) VALUES ('Empleo');
INSERT INTO opportunities_type (typeName) VALUES ('Internado');
INSERT INTO opportunities_type (typeName) VALUES ('Beca');
INSERT INTO opportunities_type (typeName) VALUES ('Proyecto de Investigación');

-- Se añaden los dos tipos de usuarios
INSERT INTO roles (roleName) VALUES ('Contribuidor');
INSERT INTO roles (roleName) VALUES ('Administrador');

-- Se le accede los privilegio a los usuarios y administradores
CREATE USER IF NOT EXISTS user@localhost
IDENTIFIED BY '';

CREATE USER IF NOT EXISTS admin@localhost
IDENTIFIED BY '';

GRANT SELECT, INSERT, UPDATE, DELETE
ON opportuniHubDB.*
TO admin@localhost;

GRANT SELECT, INSERT, UPDATE, DELETE
ON opportuniHubDB.*
TO user@localhost;