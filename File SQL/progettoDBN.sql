/* Visualizzo lo storage engine attualmente in uso. 
SELECT @@default_storage_engine */

/* Cancello il db DBSTV se esiste per poter lanciare in maniera pulita nuovamente la query, dopodichè lo creo e lo seleziono */
DROP DATABASE IF EXISTS NATURE;
/* Creo il database EPOOL impostando codifica caratteri */
CREATE DATABASE NATURE CHARACTER SET utf8 COLLATE utf8_general_ci;
/* Imposto EPOOL come db da utilizzare */
USE NATURE;

/* Creazione pulita della tabella SEMPLICE */
DROP TABLE IF EXISTS SEMPLICE;
CREATE TABLE SEMPLICE(
	nomeUtente VARCHAR(64) PRIMARY KEY, #255 per il dominio e 64 per l'utente
	psw VARCHAR(32),
	email  VARCHAR(64),
	annoNascita INT,
	dataRegistrazione DATE,
	professione VARCHAR(64)
    #foto
)engine = InnoDB;

/* Creazione pulita della tabella PREMIUM  */
DROP TABLE IF EXISTS PREMIUM ;
CREATE TABLE PREMIUM(
    nomeUtente VARCHAR(64) PRIMARY KEY,
    psw VARCHAR(32),
    email  VARCHAR(64),
	annoNascita INT,
    dataRegistrazione DATE,
    professione VARCHAR(64),
    #foto
    classifCorrette INT,
    classifNonCorrette INT,
    classifTotali INT,
    affidabilita FLOAT,
    contatore INT
)engine = InnoDB;

/* Creazione pulita della tabella  AMMINISTRATORE */
DROP TABLE IF EXISTS AMMINISTRATORE;
CREATE TABLE AMMINISTRATORE(
	nomeUtente VARCHAR(64) PRIMARY KEY, 
	psw VARCHAR(32),
	email  VARCHAR(64),
	annoNascita INT,
	dataRegistrazione DATE,
	professione VARCHAR(64)
    #foto
)engine = InnoDB;

/* Creazione pulita della tabella  SPECIE*/
DROP TABLE IF EXISTS SPECIE ;
CREATE TABLE SPECIE(
	nomeLatino VARCHAR(64) PRIMARY KEY,
    tipo CHAR,
    nomeItaliano VARCHAR(64),
    classe VARCHAR(64),
    annoClassif INT,
    vulnerabilita FLOAT,
    wikiLink VARCHAR(64),
    cmAltezza INT,
    cmDiametro INT, 
    peso FLOAT,
    mediaProle FLOAT
)engine = InnoDB;

/* Creazione pulita della tabella HABITAT */
DROP TABLE IF EXISTS HABITAT;
CREATE TABLE HABITAT(
	id VARCHAR(64) PRIMARY KEY,
    descrizione VARCHAR(500)
)engine = InnoDB;

/* Creazione pulita della tabella OSPITATA */
DROP TABLE IF EXISTS OSPITATA;
CREATE TABLE OSPITATA(
	nomeLatino VARCHAR(64) PRIMARY KEY,
    id VARCHAR(64) PRIMARY KEY,
    FOREIGN KEY(nomeLatino) REFERENCES SPECIE(nomeLatino),
    FOREIGN KEY(id) REFERENCES HABITAT(id)
)engine = InnoDB;

/* Creazione pulita della tabella  SEGNALAZIONE*/
DROP TABLE IF EXISTS SEGNALAZIONE;
CREATE TABLE SEGNALAZIONE(
	id VARCHAR(64) PRIMARY KEY,
    dataSegnalazione DATE,
    latitudineGPS INT,
    longitudineGPS INT,
    #FOTO
)engine = InnoDB;

/* Creazione pulita della tabella  PROPOSTA*/
DROP TABLE IF EXISTS PROPOSTA;
CREATE TABLE PROPOSTA(
	id VARCHAR (64) PRIMARY KEY,
    commento VARCHAR (500),
    dataProposta DATE,
    FOREIGN KEY (id) REFERENCES SEGNALAZIONE(id)
)engine = InnoDB;

/* Creazione pulita della tabella  GESTIONES*/
DROP TABLE IF EXISTS GESTIONES;
CREATE TABLE GESTIONES(
	nomeLatino VARCHAR(64) PRIMARY KEY,
    nomeUtente VARCHAR(64) PRIMARY KEY,
    tipoOperazione VARCHAR (16),
    FOREIGN KEY (nomeLatino) REFERENCES SPECIE(nomeLatino),
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente)
)engine = InnoDB;

/* Creazione pulita della tabella GESTIONEH */
DROP TABLE IF EXISTS GESTIONEH;
CREATE TABLE GESTIONEH(
	id VARCHAR(64) PRIMARY KEY,
    nomeUtente VARCHAR(64) PRIMARY KEY,
    tipoOperazione VARCHAR (16),
    FOREIGN KEY (id) REFERENCES HABITAT(id),
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente)
)engine = InnoDB;

/* Creazione pulita della tabella ESCURSIONE */
DROP TABLE IF EXISTS ESCURSIONE;
CREATE TABLE ESCURSIONE(
	id VARCHAR(64) PRIMARY KEY,
    titolo VARCHAR(32),
    dataEscursione DATE,
    oraPartenza TIME,
    oraRitorno TIME,
    #tragitto 
    descrizione VARCHAR(500),
    maxPartecipanti INT
)engine = InnoDB;

/* Creazione pulita della tabella PARTECIPATO */
DROP TABLE IF EXISTS PARTECIPATO;
CREATE TABLE PARTECIPATO(
	nomeUtente VARCHAR(64) PRIMARY KEY, 
    id VARCHAR(64) PRIMARY KEY,
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente),
    FOREIGN KEY (id) REFERENCES ESCURSIONE(id)
)engine = InnoDB;

/* Creazione pulita della tabella RACCOLTAFONDI */
DROP TABLE IF EXISTS RACCOLTAFONDI;
CREATE TABLE RACCOLTAFONDI(
	id VARCHAR(64) PRIMARY KEY,
    id2 VARCHAR(64),
    stato ENUM('APERTA', 'CHIUSA') DEFAULT 'APERTA',
    inizio DATE,
    descrizione VARCHAR(500),
    maxImporto FLOAT,
    FOFEIGN KEY (id2) REFERENCES PROGETTO RICERCA(id)
)engine = InnoDB;

/* Creazione pulita della tabella  ADESIONE*/
DROP TABLE IF EXISTS ADESIONE;
CREATE TABLE ADESIONE(
	id VARCHAR(64) PRIMARY KEY,
    nomeUtente VARCHAR(64) PRIMARY KEY,
    importoDonazione FLOAT,
    noteDonazione VARCHAR(250),
    FOREIGN KEY (id) REFERENCES RACCOLTAFONDI(id),
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente)
)engine = InnoDB;

/* Creazione pulita della tabella PROGETTORICERCA */
DROP TABLE IF EXISTS PROGETTORICERCA;
CREATE TABLE PROGETTORICERCA(
	id VARCHAR(64) PRIMARY KEY
)engine = InnoDB;

/* Creazione pulita della tabella  MESSAGGIO*/
DROP TABLE IF EXISTS MESSAGGIO;
CREATE TABLE MESSAGGIO(
	id VARCHAR(64) PRIMARY KEY,
    titolo VARCHAR(32),
    testo VARCHAR(500),
    tstamp TIMESTAMP
)engine = InnoDB;