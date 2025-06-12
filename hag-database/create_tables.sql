USE historical_apologies;

CREATE TABLE Figures
( 
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    style VARCHAR(50) NOT NULL
);

CREATE TABLE Feats
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    figure_id INT UNSIGNED NOT NULL,
    content TEXT NOT NULL,
    FOREIGN KEY (figure_id) REFERENCES Figures(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE WordBank
( 
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    word_type ENUM('figure', 'recipient', 'action', 'place', 'consequence', 'justification',
        'talent', 'fact') NOT NULL,
    content VARCHAR(255) NOT NULL
);