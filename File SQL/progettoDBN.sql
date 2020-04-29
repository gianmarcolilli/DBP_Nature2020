/* Visualizzo lo storage engine attualmente in uso. 
SELECT @@default_storage_engine */
/* Cancello il db DBSTV se esiste per poter lanciare in maniera pulita nuovamente la query, dopodichè lo creo e lo seleziono */
DROP DATABASE IF EXISTS NATURE;
/* Creo il database NATURE impostando codifica caratteri */
CREATE DATABASE NATURE CHARACTER SET utf8 COLLATE utf8_general_ci;
/* Imposto NATURE come db da utilizzare */
USE NATURE;

/* Creazione pulita della tabella UTENTE  */
DROP TABLE IF EXISTS UTENTE ;
CREATE TABLE UTENTE(
    nomeUtente VARCHAR(64) PRIMARY KEY,
    tipo ENUM('semplice','premium','amministratore') DEFAULT 'semplice',
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

/* Creazione pulita della tabella  SPECIE*/
DROP TABLE IF EXISTS SPECIE ;
CREATE TABLE SPECIE(
	nomeLatino VARCHAR(64) PRIMARY KEY,
    tipo ENUM('animale','vegetale'),
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
	id TINYINT PRIMARY KEY AUTO_INCREMENT,
    descrizione VARCHAR(500)
)engine = InnoDB;

/* Creazione pulita della tabella OSPITATA */
DROP TABLE IF EXISTS OSPITATA;
CREATE TABLE OSPITATA(
	nomeLatino VARCHAR(64),
    id TINYINT,
    PRIMARY KEY(nomeLatino, id),
    FOREIGN KEY(nomeLatino) REFERENCES SPECIE(nomeLatino) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id) REFERENCES HABITAT(id) ON DELETE CASCADE ON UPDATE CASCADE
)engine = InnoDB;

/* Creazione pulita della tabella  SEGNALAZIONE*/
DROP TABLE IF EXISTS SEGNALAZIONE;
CREATE TABLE SEGNALAZIONE(
	id TINYINT PRIMARY KEY AUTO_INCREMENT,
    nomeUtente VARCHAR(64),
    dataSegnalazione DATE,
    latitudineGPS INT,
    longitudineGPS INT,
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente)
    #FOTO
)engine = InnoDB;

/* Creazione pulita della tabella  PROPOSTA*/
DROP TABLE IF EXISTS PROPOSTA;
CREATE TABLE PROPOSTA(
	id TINYINT PRIMARY KEY AUTO_INCREMENT,
    id2 TINYINT,
    nomeUtente VARCHAR(64),
    commento VARCHAR (500),
    dataProposta DATE,
    FOREIGN KEY (id2) REFERENCES SEGNALAZIONE(id) ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY(nomeUtente) REFERENCES UTENTE(nomeUtente) ON DELETE CASCADE ON UPDATE NO ACTION
)engine = InnoDB;

/* Creazione pulita della tabella  GESTIONES*/
DROP TABLE IF EXISTS GESTIONES;
CREATE TABLE GESTIONES(
	nomeLatino VARCHAR(64),
    nomeUtente VARCHAR(64),
    tipoOperazione VARCHAR (16),
    PRIMARY KEY(nomeLatino, nomeUtente),
    FOREIGN KEY (nomeLatino) REFERENCES SPECIE(nomeLatino) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente) ON DELETE NO ACTION ON UPDATE NO ACTION
)engine = InnoDB;

/* Creazione pulita della tabella GESTIONEH */
DROP TABLE IF EXISTS GESTIONEH;
CREATE TABLE GESTIONEH(
	id TINYINT,
    nomeUtente VARCHAR(64),
    tipoOperazione VARCHAR (16) NOT NULL,
    PRIMARY KEY(id, nomeUtente),
    FOREIGN KEY (id) REFERENCES HABITAT(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente) ON DELETE NO ACTION ON UPDATE NO ACTION
)engine = InnoDB;

/* Creazione pulita della tabella ESCURSIONE */
DROP TABLE IF EXISTS ESCURSIONE;
CREATE TABLE ESCURSIONE(
	id TINYINT PRIMARY KEY AUTO_INCREMENT,
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
	nomeUtente VARCHAR(64), 
    id TINYINT,
    PRIMARY KEY (nomeUtente, id),
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (id) REFERENCES ESCURSIONE(id) ON DELETE NO ACTION ON UPDATE NO ACTION
)engine = InnoDB;

/* Creazione pulita della tabella PROGETTORICERCA */
DROP TABLE IF EXISTS PROGETTORICERCA;
CREATE TABLE PROGETTORICERCA(
	id TINYINT PRIMARY KEY AUTO_INCREMENT
)engine = InnoDB;

/* Creazione pulita della tabella RACCOLTAFONDI */
DROP TABLE IF EXISTS RACCOLTAFONDI;
CREATE TABLE RACCOLTAFONDI(
	id TINYINT PRIMARY KEY AUTO_INCREMENT,
    id2 TINYINT,
    stato ENUM('APERTA', 'CHIUSA') DEFAULT 'APERTA',
    inizio DATE,
    descrizione VARCHAR(500),
    maxImporto FLOAT,
    FOREIGN KEY (id2) REFERENCES PROGETTORICERCA(id) ON DELETE CASCADE ON UPDATE CASCADE
)engine = InnoDB;

/* Creazione pulita della tabella  ADESIONE*/
DROP TABLE IF EXISTS ADESIONE;
CREATE TABLE ADESIONE(
	id TINYINT,
    nomeUtente VARCHAR(64),
    importoDonazione FLOAT,
    noteDonazione VARCHAR(250),
    PRIMARY KEY (id, nomeUtente),
    FOREIGN KEY (id) REFERENCES RACCOLTAFONDI(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (nomeUtente) REFERENCES UTENTE(nomeUtente) ON DELETE NO ACTION ON UPDATE NO ACTION
)engine = InnoDB;

/* Creazione pulita della tabella  MESSAGGIO*/
DROP TABLE IF EXISTS MESSAGGIO;
CREATE TABLE MESSAGGIO(
	id TINYINT PRIMARY KEY,
    nomeUtenteMittente VARCHAR(64),
	nomeUtenteDestinatario VARCHAR(64),
    titolo VARCHAR(32),
    testo VARCHAR(500),
    tstamp TIMESTAMP,
    FOREIGN KEY (nomeUtenteMittente) REFERENCES UTENTE(nomeUtente) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (nomeUtenteDestinatario) REFERENCES UTENTE(nomeUtente) ON DELETE CASCADE ON UPDATE CASCADE
)engine = InnoDB;

/************************************************************************************************* Trigger ********************************************************************************************************/
/* Creo Trigger che mi promuove l'utente da UTENTE SEMPLICE a UTENTE PREMIUM all'inserimento della 3 segnalazione */
DROP TRIGGER IF EXISTS PromozioneUtente;
DELIMITER |
CREATE TRIGGER PromozioneUtente 
AFTER INSERT ON SEGNALAZIONE 
FOR EACH ROW
BEGIN

IF(EXISTS(SELECT nomeUtente
	FROM SEGNALAZIONE
	WHERE nomeUtente = new.nomeUtente AND
	nomeUtente IN (SELECT nomeUtente
		FROM UTENTE
        WHERE tipo = 'semplice' )
	GROUP BY nomeUtente
    HAVING COUNT(*)>2))
    
THEN
UPDATE UTENTE SET tipo='premium' WHERE nomeUtente = new.nomeUtente;    
END IF;
    
END;
|
DELIMITER ;

/* Creo Trigger che controlla importo delle donazioni relative ad una specifica raccolta fondi e ne determina lo stato se Aperta o Chiusa . */
DROP TRIGGER IF EXISTS cambioStatoRF;
DELIMITER |
CREATE TRIGGER cambioStatoRF
AFTER INSERT ON ADESIONE
FOR EACH ROW
BEGIN

DECLARE somma FLOAT;
SET somma = (
		SELECT SUM(importoDonazione)
        FROM ADESIONE
        WHERE id = new.id
);

IF ( somma >= (
	SELECT maxImporto
    FROM RACCOLTAFONDI
    WHERE id = new.id
    ))
THEN
   
   UPDATE RACCOLTAFONDI SET stato = 'CHIUSA' WHERE id = new.id;

END IF;

END;
|
DELIMITER ;

