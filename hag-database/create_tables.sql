USE frogparts;

CREATE TABLE Frogs
( FrogName VARCHAR(50) NOT NULL PRIMARY KEY,
Color ENUM('green', 'red', 'blue') NOT NULL,
Arm ENUM('armfrog', 'armcrab', 'armdog'),
Leg ENUM('legfrog', 'legcrab', 'legdog')
);

CREATE TABLE Feedback
( ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
FrogName VARCHAR(50) NOT NULL,
Email VARCHAR(50) NOT NULL,
Name VARCHAR(50) NOT NULL,
Message TEXT NOT NULL,
FOREIGN KEY (FrogName) REFERENCES Frogs(FrogName)
);