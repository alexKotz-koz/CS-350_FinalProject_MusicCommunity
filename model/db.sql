CREATE TABLE accounts (id INT PRIMARY KEY AUTO_INCREMENT, fullName VARCHAR(80),favoriteArtist VARCHAR(80), username VARCHAR(80) NOT NULL, password VARCHAR(80) NOT NULL );

CREATE TABLE userData (id INT PRIMARY KEY AUTO_INCREMENT, userSongName VARCHAR(80) , userSongFile VARCHAR(80) ,userCoverArt VARCHAR(80), ownerID INT REFERENCES Accounts (id));

--Use favorite artist in UserData for embedded spotify uri

--Make user song name and file not null in php form