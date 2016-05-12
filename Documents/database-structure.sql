DROP TYPE IF EXISTS STATUT CASCADE;
DROP TYPE IF EXISTS DOC CASCADE;
DROP TYPE IF EXISTS DOM CASCADE;
DROP TYPE IF EXISTS TACHE CASCADE;
CREATE TYPE STATUT as ENUM ('Responsable', 'Coordinateur', 'Chercheur');
CREATE TYPE DOM as ENUM ('Biologie', 'Informatique', 'Chimie', 'Physique');
CREATE TYPE DOC as ENUM ('Compte rendu réunion', 'Rapport expérience', 'Brouillon', 'Livrable');
CREATE TYPE TACHE as ENUM('Réunion', 'Expérience', 'Tests', 'Documentation', 'Jalon', 'Avancement');

DROP TABLE IF EXISTS Chercheur CASCADE;
CREATE TABLE Chercheur (idCh SERIAL NOT NULL,
loginCh VARCHAR(10),
passCh VARCHAR(25),
numBureau INT,
nomCh VARCHAR(30),
prenomCh VARCHAR(30),
mail VARCHAR(70),
numTel INT,
idEquipe INT,
PRIMARY KEY (idCh) );

DROP TABLE IF EXISTS Équipe CASCADE;
CREATE TABLE Équipe (idEquipe SERIAL NOT NULL,
nomEq VARCHAR(25),
sigle VARCHAR(10),
specialite VARCHAR(25),
description TEXT,
idLabo INT NOT NULL,
PRIMARY KEY (idEquipe) )  ;

DROP TABLE IF EXISTS Laboratoire CASCADE;
CREATE TABLE Laboratoire (idLabo SERIAL NOT NULL,
nomLabo VARCHAR(25),
adresseLabo VARCHAR(25),
descriptionLabo TEXT,
Domaine DOM,
PRIMARY KEY (idLabo) )  ;

DROP TABLE IF EXISTS Publication CASCADE;
CREATE TABLE Publication (idPubli SERIAL NOT NULL,
titre VARCHAR(50),
datePubli DATE,
urlPub INT,
PRIMARY KEY (idPubli) )  ;

DROP TABLE IF EXISTS Message CASCADE;
CREATE TABLE Message (idDiscussion SERIAL NOT NULL,
titreMessage VARCHAR(50),
objet VARCHAR(100),
contenuMess TEXT,
dateEnvoi INT,
idCh INT NOT NULL,
idProjet INT NOT NULL,
PRIMARY KEY (idDiscussion) )  ;

DROP TABLE IF EXISTS Tâche CASCADE;
CREATE TABLE Tâche (idTache SERIAL NOT NULL,
nomTache VARCHAR(50),
typeTache TACHE,
descriptionTaches VARCHAR(500),
idProjet INT NOT NULL,
idCal INT NOT NULL,
PRIMARY KEY (idTache) )  ;

DROP TABLE IF EXISTS Projet CASCADE;
CREATE TABLE Projet (idProjet SERIAL NOT NULL,
nomProjet VARCHAR(25),
budget INT,
DescriptionProjet TEXT,
idCh INT NOT NULL,
idCal INT NOT NULL,
PRIMARY KEY (idProjet) )  ;

DROP TABLE IF EXISTS Participe CASCADE;
CREATE TABLE Participe
(
	idCh 		SERIAL NOT NULL,
	idProjet 	SERIAL NOT NULL,

	statut 	STATUT,

	PRIMARY KEY(idCh, idProjet)
);

DROP TABLE IF EXISTS Calendrier CASCADE;
CREATE TABLE Calendrier (idCal SERIAL NOT NULL,
dateDebut DATE,
dateFin DATE,
PRIMARY KEY (idCal) )  ;

DROP TABLE IF EXISTS Document CASCADE;
CREATE TABLE Document (idDoc SERIAL NOT NULL,
titreDoc VARCHAR(50),
typeDoc DOC,
urlDoc VARCHAR(50),
PRIMARY KEY (idDoc) )  ;

DROP TABLE IF EXISTS Publie CASCADE;
CREATE TABLE Publie (idCh SERIAL NOT NULL,
idPubli INT NOT NULL,
PRIMARY KEY (idCh,
 idPubli) )  ;

DROP TABLE IF EXISTS Dépose CASCADE;
CREATE TABLE Dépose (idDoc SERIAL NOT NULL,
idCh INT NOT NULL,
PRIMARY KEY (idDoc,
 idCh) )  ;

DROP TABLE IF EXISTS effectue CASCADE;
CREATE TABLE effectue (idCh SERIAL NOT NULL,
idTache INT NOT NULL,
PRIMARY KEY (idCh,
 idTache) )  ;

ALTER TABLE Chercheur ADD CONSTRAINT FK_Chercheur_idEquipe FOREIGN KEY (idEquipe) REFERENCES Équipe (idEquipe);

ALTER TABLE Équipe ADD CONSTRAINT FK_Équipe_idLabo FOREIGN KEY (idLabo) REFERENCES Laboratoire (idLabo);
ALTER TABLE Message ADD CONSTRAINT FK_Message_idCh FOREIGN KEY (idCh) REFERENCES Chercheur (idCh);
ALTER TABLE Message ADD CONSTRAINT FK_Message_idProjet FOREIGN KEY (idProjet) REFERENCES Projet (idProjet);
ALTER TABLE Tâche ADD CONSTRAINT FK_Tâche_idProjet FOREIGN KEY (idProjet) REFERENCES Projet (idProjet);
ALTER TABLE Tâche ADD CONSTRAINT FK_Tâche_idCal FOREIGN KEY (idCal) REFERENCES Calendrier (idCal);
ALTER TABLE Projet ADD CONSTRAINT FK_Projet_idCh FOREIGN KEY (idCh) REFERENCES Chercheur (idCh);
ALTER TABLE Projet ADD CONSTRAINT FK_Projet_idCal FOREIGN KEY (idCal) REFERENCES Calendrier (idCal);
ALTER TABLE Publie ADD CONSTRAINT FK_Publie_idCh FOREIGN KEY (idCh) REFERENCES Chercheur (idCh);
ALTER TABLE Publie ADD CONSTRAINT FK_Publie_idPubli FOREIGN KEY (idPubli) REFERENCES Publication (idPubli);
ALTER TABLE Dépose ADD CONSTRAINT FK_Dépose_idDoc FOREIGN KEY (idDoc) REFERENCES Document (idDoc);
ALTER TABLE Dépose ADD CONSTRAINT FK_Dépose_idCh FOREIGN KEY (idCh) REFERENCES Chercheur (idCh);
ALTER TABLE effectue ADD CONSTRAINT FK_effectue_idCh FOREIGN KEY (idCh) REFERENCES Chercheur (idCh);
ALTER TABLE effectue ADD CONSTRAINT FK_effectue_idTache FOREIGN KEY (idTache) REFERENCES Tâche (idTache);
ALTER TABLE Participe ADD CONSTRAINT FK_Participe_idCh FOREIGN KEY (idCh) REFERENCES Chercheur (idCh);
ALTER TABLE Participe ADD CONSTRAINT FK_Participe_idProjet FOREIGN KEY (idProjet) REFERENCES Projet (idProjet);