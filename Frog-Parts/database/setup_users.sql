CREATE USER 'frogparts'@'localhost' IDENTIFIED BY 'frogparts123';
GRANT SELECT, INSERT, UPDATE, DELETE ON frogparts.* TO 'frogparts'@'localhost';