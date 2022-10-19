use javajam;

CREATE TABLE coffee 
(id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT , 
coffee VARCHAR(30) NOT NULL , 
type VARCHAR(30) NULL DEFAULT NULL , 
price FLOAT(5,2) NOT NULL , 
PRIMARY KEY (id));

INSERT INTO coffee VALUES 
('Just Java', , 2.00),
('Cafe au Lait', 'Single', 2.00),
('Cafe au Lait', 'Double', 3.00),
('Iced Cappuccino', 'Single', 4.75),
('Iced Cappuccino', 'Double', 5.75);

CREATE TABLE order_text 
(id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT , 
coffee VARCHAR(30) NOT NULL , 
type VARCHAR(30) NULL DEFAULT NULL , 
total_price FLOAT(5,2) NOT NULL , 
quantity INT(6) NOT NULL , 
PRIMARY KEY (id));