DROP DATABASE IF EXISTS portalDB;
CREATE DATABASE portalDB;
USE portalDB;

CREATE TABLE users (
  userID        INT            NOT NULL AUTO_INCREMENT,
  email         VARCHAR(150)   NOT NULL,
  password      VARCHAR(255)   NOT NULL,
  role          VARCHAR(50)    NOT NULL,
  PRIMARY KEY (userID),
  UNIQUE INDEX email (email)
);

CREATE TABLE opportunities (
  oppID           INT            NOT NULL AUTO_INCREMENT,
  oppType         INT            NOT NULL,
  ownerUserID     INT            NOT NULL,
  title           VARCHAR(200)   NOT NULL,
  description     TEXT           NOT NULL,
  sponsor         VARCHAR(150)            DEFAULT NULL,
  url             VARCHAR(255)            DEFAULT NULL,
  attachmentPath  VARCHAR(255)            DEFAULT NULL,
  deadline        DATE                     DEFAULT NULL,
  datePosted      DATE           NOT NULL  DEFAULT (CURRENT_DATE),
  PRIMARY KEY (oppID),
  INDEX ownerUserID (ownerUserID),
  FOREIGN KEY (ownerUserID)

);

CREATE TABLE distribution_list (
  email     VARCHAR(150) NOT NULL,
  PRIMARY KEY (email),
);

CREATE USER IF NOT EXISTS user@localhost
IDENTIFIED BY '';

CREATE USER IF NOT EXISTS admin@localhost
IDENTIFIED BY '';

GRANT SELECT, INSERT, UPDATE, DELETE
ON portalDB.*
TO admin@localhost;

GRANT SELECT, INSERT, UPDATE, DELETE
ON portalDB.*
TO user@localhost;
