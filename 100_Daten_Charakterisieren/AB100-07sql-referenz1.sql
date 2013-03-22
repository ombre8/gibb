-- Describe MYFRIENDS
CREATE TABLE "MyFriends" (
    "ID" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "Name" TEXT,
    "Vorname" TEXT,
    "Strasse" TEXT,
    "email" TEXT,
    "FKORTSID" INTEGER
)
-- Describe ORT
CREATE TABLE "ORT" (
    "Ortsid" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "PLZ" INTEGER,
    "Ortsname" TEXT
)
INSERT INTO ort (PLZ, Ortsname) VALUES ('3001', 'Bern')
INSERT INTO ort (PLZ, Ortsname) VALUES ('3005', 'Bern')
INSERT INTO ort (PLZ, Ortsname) VALUES ('8001', 'Zürich')
INSERT INTO ort (PLZ, Ortsname) VALUES ('8002', 'Zürich')
INSERT INTO ort (PLZ, Ortsname) VALUES ('3280', 'Murten')
INSERT INTO ort (PLZ, Ortsname) VALUES ('3715', 'Adelboden')
INSERT INTO ort (PLZ, Ortsname) VALUES ('4053', 'Basel')
INSERT INTO ort (PLZ, Ortsname) VALUES ('1200', 'Genf')
INSERT INTO ort (PLZ, Ortsname) VALUES ('4105', 'Biel')
INSERT INTO ort (PLZ, Ortsname) VALUES ('3922', 'Stalden')
INSERT INTO ort (PLZ, Ortsname) VALUES ('1400', 'Yverdon')
INSERT INTO ort (PLZ, Ortsname) VALUES ('5600', 'Lenzburg')
SELECT * From ort
SELECT COUNT (*) AS "Azahl Orte" FROM ort
SELECT SUM(PLZ) AS "Summe PLZ" FROM ort
SELECT PLZ, Ortsname FROM ort WHERE Ortsname < 'G'
SELECT PLZ, Ortsname FROM ort WHERE Ortsname LIKE 'B%'
SELECT MIN(Ortsname) From ort
SELECT PLZ, Ortsname From ort GROUP BY Ortsname
SELECT AVG(PLZ)*0.1 AS "10% - Durchschnitt" FROM Ort
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Maurer', 'Ralph', 'ralph.maurer@gibb.ch')
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Frei', 'Beat', 'beat.frei@gibb.ch')
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Glarner', 'Reto', 'reto.glarner@gibb.ch')
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Schluep', 'miriam', 'miriam.schluep@gibb.ch')
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Yilmaz', 'Günel', 'guenel.yilmaz@gibb.ch')
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Bielawski', 'barbara', 'barbara.Bielawski@gibb.ch')
SELECT * FROM myfriends
UPDATE myfriends SET Vorname = 'Miriam' WHERE Vorname='miriam'
UPDATE myfriends SET Vorname = 'Barbara' WHERE Vorname='barbara'
SELECT * FROM myfriends
UPDATE myfriends Set FKORTSID= (SELECT ORTSID FROM ort WHERE Ortsname='Murten') WHERE Name = 'Maurer'
SELECT * FROM myfriends
UPDATE myfriends SET FKORTSID=2 WHERE ID = 2 
UPDATE myfriends SET FKORTSID = 6 WHERE ID = 3 
UPDATE myfriends SET FKORTSID = 7 WHERE ID = 4 
UPDATE myfriends  SET FKORTSID = 3 WHERE ID = 5 
UPDATE myfriends  SET FKORTSID = 13 WHERE ID = 6
SELECT * FROM myfriends
-- AB100 - 08
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Duddle', 'Hugo', 'hugod@gmail.com')
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Osipov', 'Valerie', 'vosi@mail.ru')
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Daniels', 'Jack', 'nogo@whiskey.com')
INSERT INTO myfriends (Name, Vorname, email) VALUES ('Khortyza', 'Vodki', 'go@vodka.com')

INSERT INTO ort (PLZ, Ortsname) VALUES ('4105', 'Biel')
INSERT INTO ort (PLZ, Ortsname) VALUES ('1200', 'Genf')

SELECT * FROM ort
SELECT * FROM myfriends

SELECT * FROM myfriends AS f
JOIN ort AS o ON f.FKORTSID=o.ortsid

SELECT * From myfriends AS f
LEFT JOIN ort as o On f.FKORTSID=o.ORTSID

SELECT Vorname, Name, email FROM MYFRIENDS AS f
LEFT JOIN ORT AS o ON f.FKORTSID=o.ortsid WHERE o.ortsid IS NULL

SELECT plz, ortsname FROM ort AS o
LEFT Join myfriends as f on f.fkortsid=o.ortsid WHERE f.fkortsid IS NULL

SELECT plz, ortsname FROM myfriends, ort

#AB100-08

SELECT * FROM ort WHERE ortsname LIKE 'B%' OR 'Z%'

SELECT vorname, name, email, ortsname FROM myfriends AS f
LEFT JOIN ort as o On f.FKORTSID=o.ORTSID
GROUP BY Ortsname

SELECT vorname, name, email FROM myfriends WHERE FKORTSID IS NULL
GROUP BY name

UPDATE myfriends  SET vorname = 'Vodka' WHERE name = 'Khortyza'

INSERT INTO myfriends (name, vorname, email, FKORTSID) VALUES ('Gsponer', 'Charly', 'cg@vs.ch', (SELECT ORTSID FROM ort WHERE ortsname = 'Stalden'))

SELECT id, vorname, name, ortsname FROM myfriends AS f
LEFT JOIN ort as o On f.FKORTSID=o.ORTSID WHERE ortsname IS 'Bern' OR  ortsname IS 'Genf' OR  ortsname IS 'Zürich'

SELECT Ortsname From Ort ORDER BY ortsname Limit 6

SELECT * FROM ort, myfriends

SELECT ID, name, email, plz, ortsname FROM myfriends  AS f
LEFT JOIN ort AS o ON o.ortsid = f.fkortsid GROUP BY Ortsname

SELECT DISTINCT ortsname FROM ort ORDER BY ortsname

UPDATE myfriends SET FKORTSID = (SELECT ortsid FROM ort WHERE ortsname = 'Yverdon') WHERE name = 'Duddle' AND vorname = 'Hugo'

##CHECK##
SELECT * FROM myfriends
SELECT * FROM ort


##AB09##
SELECT * FROM kunden
SELECT Nachname, Vorname FROM Kunden ORDER BY Nachname, Vorname
SELECT Nachname, Vorname From Kunden GROUP BY Nachname, Vorname
SELECT Nachname As "gesuchte Person", Vorname, KID, Anrede, Umsatz  From Kunden WHERE Nachname Like "Meier" AND Vorname Like "Beat"
SELECT * FROM Kunden Where nachname NOT Like "Meier"
SELECT * FROM Kunden Where nachname Like "M%"
SELECT COUNT(*) AS "Anzahl" FROM Kunden
SELECT * FROM Kunden Limit 8
SELECT * FROM Kunden ORDER BY Umsatz DESC Limit 5
SELECT AVG(Umsatz) FROM Kunden As "durchschnittlicher Umsatz"
SELECT Umsatz*0.1 AS "Provision", Vorname, Nachname From Kunden
Select * FROM Kunden WHERE Umsatz Like  NULL OR '0'

UPDATE Kunden SET Anrede="Mister" WHERE Anrede="Herr"
INSERT INTO Kunden (Anrede, Nachname, Vorname) VALUES ("Frau", "Muster", "Doris")
DELETE FROM Kunden WHERE Umsatz < 200
--* = %
--? = _

--6 
SELECT COUNT(r.AID) AS ANZAHL, a.Artikel FROM Artikel AS a
	JOIN relKkauftA AS r ON a.AID= r.AID 
		GROUP BY a.Artikel 
		ORDER BY COUNT(r.AID) DESC;
	
--7 
SELECT k.KID, Vorname, Nachname FROM KUNDEN AS k
	LEFT JOIN relKkauftA AS r ON r.KID = k.KID
	WHERE r.KID IS NULL;

--8 
SELECT COUNT(r.AID) AS ANZAHL, a.Artikel FROM Artikel AS a
	JOIN relKkauftA AS r ON a.AID= r.AID 
	GROUP BY a.Artikel 
	ORDER BY COUNT(r.AID) DESC;

--9 (i.O.)
SELECT k.Nachname,k.Vorname, Umsatz FROM KUNDEN AS k
	WHERE Umsatz > (SELECT avg(Umsatz)*1.2 FROM KUNDEN);
	

-- AB 10

CREATE TABLE Personen (PID INTEGER PRIMARY KEY, Anrede TEXT, Vorname TEXT, Nachname TEXT, Geburtstag TEXT, Gehalt TEXT, RID INTEGER, TID Integer, V_PID INTEGER)
CREATE TABLE Raueme (RID INTEGER, Raum TEXT)
CREATE TABLE Telefone (TID INTEGER, Telefon TEXT, RID INTEGER)

sqlite> .separator ";"
sqlite> .import AB100-10_Personen.csv Personen
sqlite> .import AB100-10_Raeume.csv Raueme
sqlite> .import AB100-10_Telefone.csv Telefone

Select * FROM Personen
INSERT INTO Personen (Anrede, Vorname, Nachname) VALUES ("Dies", "sollte", "Failen")
SELECT Nachname, Vorname, Geburtstag FROM Personen
SELECT Nachname, Vorname FROM Personen ORDER BY Nachname, Vorname
UPDATE Personen SET Nachname="Gemüse" WHERE Nachname="Obst"
SELECT COUNT(Nachname) AS "Anzahl", Nachname FROM Personen Group BY Nachname
