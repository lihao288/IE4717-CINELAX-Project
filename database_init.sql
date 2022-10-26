CREATE DATABASE IF NOT EXISTS cinemalax;

USE cinemalax;

CREATE TABLE ant_man (
  OrderID BIGINT NOT NULL , 
  Movie VARCHAR(60) NOT NULL , 
  BookingDate VARCHAR(20) NOT NULL , 
  BookingTime VARCHAR(10) NOT NULL , 
  Quantity VARCHAR(3) NOT NULL ,
  SelectedSeats VARCHAR(60) NOT NULL ,
  PRIMARY KEY (OrderID)) 
  ENGINE = InnoDB; 

-- INSERT INTO ant_man(OrderId, Movie, BookingDate, BookingTime, Quantity, SelectedSeats)
-- VALUES(UUID_SHORT(), 'Ant-Man', 'Wed Oct 26 2022', '10:30 AM', 3, 'A03,A04,A05');