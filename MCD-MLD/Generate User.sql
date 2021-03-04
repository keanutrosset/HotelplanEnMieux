CREATE USER 'TPIuser'@'localhost' IDENTIFIED BY 'Pa$$w0rd';
GRANT USAGE ON *.* TO 'TPIuser'@'localhost';
GRANT CREATE, UPDATE, SELECT, DELETE  ON `hotelplanenmieux`.* TO 'TPIuser'@'localhost';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'TPIuser'@'localhost';