CREATE USER 'hag_user'@'localhost' IDENTIFIED BY '1DnTiHcTbPbAs51';
GRANT SELECT, INSERT, UPDATE, DELETE ON historical_apologies.* TO 'hag_user'@'localhost';