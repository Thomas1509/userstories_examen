DROP DATABASE IF EXISTS VoedselbankKlant;
CREATE DATABASE VoedselbankKlant;
USE VoedselbankKlant;
SET FOREIGN_KEY_CHECKS=0;

-- Create Gezin Tabel
CREATE TABLE Gezin (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Naam VARCHAR(50) NOT NULL,
    Code VARCHAR(10) NOT NULL,
	Omschrijving VARCHAR(50) NOT NULL,
    AantalVolwassenen INT NOT NULL,
    AantalKinderen INT NOT NULL,
    AantalBabys INT NOT NULL,
    TotaalAantalPersonen INT NOT NULL,
    Opmerking VARCHAR(200) NULL,
    IsActive bit(1) NOT NULL,
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Create Persoon Tabel
CREATE TABLE Persoon (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gezin_id INT UNSIGNED NULL,
    Voornaam VARCHAR(50) NOT NULL,
    Tussenvoegsel VARCHAR(50) NULL,
	Achternaam VARCHAR(50) NOT NULL,
	Geboortedatum DATETIME NOT NULL,
	TypePersoon varchar(25) NOT NULL,
	IsVertegenwoordiger tinyint(1) NOT NULL,
    Opmerking VARCHAR(200) NULL,
    IsActive bit(1) NOT NULL,
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (gezin_id) REFERENCES Gezin(Id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Create Contact Tabel
CREATE TABLE Contact (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Straat VARCHAR(50) NOT NULL,
	Huisnummer INT NOT NULL,
	Toevoeging VARCHAR(10) NULL,
	Postcode VARCHAR(10) NOT NULL,
	Woonplaats VARCHAR(50) NOT NULL,
	Email VARCHAR(50) NOT NULL,
	Mobiel VARCHAR(13) NOT NULL,
	Opmerking VARCHAR(200) NULL,
	IsActive bit(1) NOT NULL,
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB;

-- Create ContactPerPerGezin Tabel
CREATE TABLE ContactPerGezin (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gezin_id INT UNSIGNED NOT NULL,
    contact_id INT UNSIGNED NOT NULL,
    Opmerking VARCHAR(200) NULL,
    IsActive bit(1) NOT NULL,
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (gezin_id) REFERENCES Gezin(Id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (contact_id) REFERENCES Contact(Id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

 -- Insert Values
INSERT INTO Gezin (Naam, Code, Omschrijving, AantalVolwassenen, AantalKinderen, AantalBabys, TotaalAantalPersonen)
VALUES ("ZevenhuizenGezin", "G0001", "Bijstandsgezin", 2, 2, 0, 4),
       ("BergkampGezin", "G0002", "Bijstandsgezin", 2, 1, 1, 4),
       ("HeuvelGezin", "G0003", "Bijstandsgezin", 2, 0, 0, 2),
       ('ScherderGezin', "G0004", "Bijstandsgezin", 1, 0, 2, 3),
       ('DeJongGezin', 'G0005', 'Bijstandsgezin', 1, 1, 0, 2),
       ('VanderBergGezin', 'G0006', 'AlleenGaande', 1, 0, 0,1);

INSERT INTO Persoon (gezin_id, Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, TypePersoon, IsVertegenwoordiger)
VALUES 
(NULL, 'Hans', 'van', 'Leeuwen', '1958-02-12', 'Manager', 0),
(NULL, 'Jan', 'van der', 'Sluijs', '1993-04-30', 'Medewerker', 0),
(NULL, 'Herman', 'den', 'Duiker', '1989-08-30', 'Vrijwilliger', 0),
(1, 'Johan', 'van', 'Zevenhuizen', '1990-05-20', 'Klant', 1),
(1, 'Sarah', 'den', 'Dolder', '1985-03-23', 'Klant', 0),
(1, 'Theo', 'van', 'Zevenhuizen', '2015-03-08', 'Klant', 0),
(1, 'Jantien', 'van', 'Zevenhuizen', '2016-09-20', 'Klant', 0),
(2, 'Arjan', NULL, 'Bergkamp', '1968-07-12', 'Klant', 1),
(2, 'Janneke', NULL, 'Sanders', '1969-05-11', 'Klant', 0),
(2, 'Stein', NULL, 'Bergkamp', '2009-02-02', 'Klant', 0),
(2, 'Judith', NULL, 'Bergkamp', '2022-02-05', 'Klant', 0),
(3, 'Mazin', 'van', 'Vliet', '1968-08-18', 'Klant', 0),
(3, 'Selma', 'van de', 'Heuvel', '1965-09-04', 'Klant', 1),
(4, 'Eva', NULL, 'Scherder', '2000-04-07', 'Klant', 1),
(4, 'Felicia', NULL, 'Scherder', '2021-11-29', 'Klant', 0),
(4, 'Devin', NULL, 'Scherder', '2023-03-01', 'Klant', 0),
(5, 'Frieda', NULL, 'de Jong', '1980-09-04', 'Klant', 1),
(5, 'Simeon', NULL, 'de Jong', '2018-05-23', 'Klant', 0),
(6, 'Hanna', 'van der', 'Berg', '1999-09-09', 'Klant', 1);

        
INSERT INTO ContactPerGezin (gezin_id, contact_id)
VALUES (1, 1),
        (2, 2),
        (3, 3),
        (4, 4),
        (5, 5),
        (6, 6);
        
INSERT INTO Contact (Straat, Huisnummer, Toevoeging, Postcode, Woonplaats, Email, Mobiel)
VALUES 
('Prinses Irenestraat', 12, 'A', '5271TH', 'Maaskantje', 'j.van.zevenhuizen@gmail.com', '+31 623456123'),
('Gibraltarstraat', 234, NULL, '5271TJ', 'Maaskantje', 'a.bergkamp@hotmail.com', '+31 623456123'),
('Der Kinderenstraat', 456, 'Bis', '5271TH', 'Maaskantje', 's.van.de.heuvel@gmail.com', '+31 623456123'),
('Nachtegaalstraat', 233, 'A', '5271TJ', 'Maaskantje', 'e.scherder@gmail.com', '+31 623456123'),
('Bertram Russellstraat', 45, NULL, '5271TH', 'Maaskantje', 'f.de.jong@hotmail.com', '+31 623456123'),
('Leonardo Da VinciHof', 34, NULL, '5271ZE', 'Maaskantje', 'h.van.der.berg@gmail.com', '+31 623456123'),
('Siegfried Knutsenlaan', 234, NULL, '5271ZE', 'Maaskantje', 'r.ter.weijden@ah.nl', '+31 623456123'),
('Theo de Bokstraat', 256, NULL, '5271ZH', 'Maaskantje', 'l.pastoor@gmail.com', '+31 623456123'),
('Meester van Leerhof', 2, 'A', '5271ZH', 'Maaskantje', 'm.yazidi@gemeenteutrecht.nl', '+31 623456123'),
('Van Wemelenplantsoen', 300, NULL, '5271TH', 'Maaskantje', 'b.van.driel@gmail.com', '+31 623456123'),
('Terlingenhof', 20, NULL, '5271TH', 'Maaskantje', 'j.pastorius@gmail.com', '+31 623456356'),
('Veldhoen', 31, NULL, '5271ZE', 'Maaskantje', 's.dollaard@gmail.com', '+31 623452314'),
('ScheringaDreef', 37, NULL, '5271ZE', 'Vught', 'j.blokker@gemeentevught.nl', '+31 623452314');

 
-- Selects  
SELECT * FROM Gezin;
SELECT * FROM Persoon;
SELECT * FROM Contact;
SELECT * FROM ContactPerGezin;

