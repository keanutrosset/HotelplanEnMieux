CREATE USER 'hpmieux21_hpm'@'localhost' IDENTIFIED BY 'HPMieux-21';
GRANT USAGE ON *.* TO 'hpmieux21_hpm'@'localhost';
GRANT CREATE, UPDATE, SELECT, DELETE  ON `hotelplanenmieux`.* TO 'hpmieux21_hpm'@'localhost';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'hpmieux21_hpm'@'localhost';