USE historical_apologies;

CREATE TABLE Figures
( 
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name CHAR(50) NOT NULL,
    style CHAR(50) NOT NULL
);

CREATE TABLE WordBank
( 
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    word_type ENUM('figure', 'recipient', 'action', 'place', 'consequence', 'justification', 'talent', 
        'feat', 'fact') NOT NULL,
    content VARCHAR(255) NOT NULL
);