CREATE DATABASE IF NOT EXISTS cinelax;

USE cinelax;

DROP TABLE IF EXISTS ant_man;
DROP TABLE IF EXISTS black_panther;
DROP TABLE IF EXISTS doctor_strange;
DROP TABLE IF EXISTS eternals;
DROP TABLE IF EXISTS guardians;
DROP TABLE IF EXISTS shangchi;
DROP TABLE IF EXISTS spiderman;
DROP TABLE IF EXISTS thor;
DROP TABLE IF EXISTS customers_info;

CREATE TABLE ant_man (
  OrderID VARCHAR(6) NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Hall VARCHAR(10) NOT NULL , 
  Quantity INT(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  TransactionTime VARCHAR(30) NOT NULL ,
  PaymentDone BOOLEAN NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 
  
CREATE TABLE black_panther (
  OrderID VARCHAR(6) NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Hall VARCHAR(10) NOT NULL , 
  Quantity INT(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  TransactionTime VARCHAR(30) NOT NULL ,
  PaymentDone BOOLEAN NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 

CREATE TABLE doctor_strange (
  OrderID VARCHAR(6) NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Hall VARCHAR(10) NOT NULL , 
  Quantity INT(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  TransactionTime VARCHAR(30) NOT NULL ,
  PaymentDone BOOLEAN NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 

CREATE TABLE eternals (
  OrderID VARCHAR(6) NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Hall VARCHAR(10) NOT NULL , 
  Quantity INT(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  TransactionTime VARCHAR(30) NOT NULL ,
  PaymentDone BOOLEAN NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 

CREATE TABLE guardians (
  OrderID VARCHAR(6) NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Hall VARCHAR(10) NOT NULL , 
  Quantity INT(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  TransactionTime VARCHAR(30) NOT NULL ,
  PaymentDone BOOLEAN NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 

CREATE TABLE shangchi (
  OrderID VARCHAR(6) NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Hall VARCHAR(10) NOT NULL , 
  Quantity INT(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  TransactionTime VARCHAR(30) NOT NULL ,
  PaymentDone BOOLEAN NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 

CREATE TABLE spiderman (
  OrderID VARCHAR(6) NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Hall VARCHAR(10) NOT NULL , 
  Quantity INT(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  TransactionTime VARCHAR(30) NOT NULL ,
  PaymentDone BOOLEAN NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 

CREATE TABLE thor (
  OrderID VARCHAR(6) NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Hall VARCHAR(10) NOT NULL , 
  Quantity INT(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  TransactionTime VARCHAR(30) NOT NULL ,
  PaymentDone BOOLEAN NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 

CREATE TABLE customers_info (
  OrderID VARCHAR(6) NOT NULL , 
  CustomerName VARCHAR(30) NOT NULL , 
  CustomerMobileNo INT(8) NOT NULL , 
  CustomerEmail VARCHAR(60) NOT NULL , 
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 