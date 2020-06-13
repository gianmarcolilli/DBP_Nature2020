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

/************************************************************************************************* Stored Procedure ********************************************************************************************************/

DROP PROCEDURE IF EXISTS AggiungiUtente;
/* Aggiungi utente semplice*/
DELIMITER |
CREATE PROCEDURE AggiungiUtente(IN nomeU VARCHAR(64), IN passw VARCHAR(32), IN eaddress VARCHAR(64), IN birthdate DATE, IN professioneU VARCHAR(64))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
	/* Inizializzo variabile cont. */
	SET cont = (
		SELECT COUNT(*)
		FROM UTENTE
		WHERE nomeU = nomeUtente
        AND tipo = 'semplice'
    );
    
    IF cont < 1 THEN
		INSERT INTO UTENTE(nomeUtente, tipo, psw, email, annoNascita, dataRegistrazione, professione) VALUES
        (nomeU, 'semplice', passw, eaddress, birthdate, CURDATE(), professioneU);
	END IF;
    
	END;
|
DELIMITER ;

/* Eliminazione utente. */
DELIMITER |
CREATE PROCEDURE EliminaUtente(IN nomeU VARCHAR(64))
	BEGIN
	DELETE FROM UTENTE
	WHERE nomeU = nomeUtente;
	END;
|
DELIMITER ;

/*Inserimento segnalazione*/
DELIMITER |
CREATE PROCEDURE AggiungiSegnalazioneU(IN nomeU VARCHAR(64), IN latitudineS INT(11), IN longitudineS INT(11))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
    /* Controllo se la segnalazione esiste già. */
    	SET cont = (
			SELECT COUNT(*) AS existsSegn
			FROM SEGNALAZIONE
			WHERE nomeU = nomeUtente
            AND latitudineS = latitudine
            AND longitudineS = longitudine
    );
    
    IF cont < 1
    THEN
		INSERT INTO SEGNALAZIONE(nomeUtente, dataSegnalazione, latitudine, longitudine) VALUES
        (nomeU, CURDATE(), latitudineS, longitudineS);
    END IF;
    
	END;
|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE AggiungiPropostaS(IN idSegnalazione TINYINT(4), IN nomeU VARCHAR(64),IN commento VARCHAR(500))
	BEGIN 
    DECLARE cont INT DEFAULT 0;
    
    /*Controllo se la proposta è stata già inserita.*/
		SET cont = (
			SELECT count(*) AS existsProp
            FROM PROPOSTA 
            WHERE idSegnalazione = id2
            AND nomeU = nomeUtente
		);
		
        IF cont = 0
        THEN 
			INSERT INTO PROPOSTA (id2, nomeUtente, commento, dataProposta) VALUES
            (idSegnalazione, nomeU, commento, CURDATE());
		END IF;
        
    END;
|
DELIMITER ;


/*Inserimento messaggio*/
DELIMITER |
CREATE PROCEDURE condividiMessaggio(IN mittente VARCHAR(64), IN destinatario VARCHAR(64),IN titolo VARCHAR(32),IN testo VARCHAR(500))
	
    BEGIN
		INSERT INTO MESSAGGIO(nomeUenteMittente, nomeUtenteDestinatario, titolo, testo, tstamp ) VALUES
        (mittente, destinatario, titolo, testo, TIMESTAMP(CURDATE()));
    END;

|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE adesioneEscursione(IN nomeU VARCHAR(64), IN idEscursione TINYINT(4))
    BEGIN
    DECLARE cont INT DEFAULT 0;
    /*Controllo se partecipazione già presente*/
		SET cont = (
			SELECT COUNT(*) AS existsPart
            FROM PARTECIPATO
            WHERE nomeU = nomeUtente 
            AND idEscursione = id);
		
        IF cont < 1
        THEN INSERT INTO PARTECIPATO(nomeUtente, id) VALUES
        (nomeU, idEscursione);
        END IF;
        
    END;
|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE adesioneRF(IN nomeU VARCHAR(64), IN idRF TINYINT(4), IN importoD FLOAT, IN noteD VARCHAR(250))
	
    BEGIN
    DECLARE cont INT DEFAULT 0;
    /*Controllo se adesione già presente*/
		SET cont = (
			SELECT count(*)
            FROM ADESIONE, RACCOLTAFONDI
            WHERE nomeU = ADESIONE.nomeUtente 
            AND idRF = ADESIONE.id
            AND RACCOLTAFONDI.tipo = 'APERTA');
            
        IF cont = 0 
        THEN INSERT INTO ADESIONE(nomeUtente, id, importoD, noteD) VALUES
        (nomeU, idRF, importoD, noteD);
        END IF;
    END;
|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE inserisciEscursione(IN idE TINYINT(4), IN titoloE VARCHAR(32),IN startE TIME, IN returnE TIME, IN note VARCHAR(500), IN maxP INT(11))
/* Creo Escursione*/
	BEGIN
		INSERT INTO ESCURSIONE(id, titolo, dataEscursione, oraPartenza, oraRitorno, descrizione, maxPartecipanti)
        VALUES(idE, titoloE, CURDATE(), startE, returnE, note, maxP);
    END;

|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE inserisciSpecieFloristica(IN latino VARCHAR(64), IN tipoS ENUM('vegetale'), IN italiano VARCHAR(64), IN class VARCHAR(64), IN annoC INT(11), IN vulnerabilita FLOAT, IN wikipedia VARCHAR(64), IN altezza INT(11), IN diametro INT(11), IN weight FLOAT, IN prole FLOAT)
/*Inserimento specie floristica*/
	BEGIN
    
    DECLARE  cont INT DEFAULT 0;
    
		SET  cont = (
        SELECT count(*) AS existsSpecie
        FROM SPECIE
        WHERE tipo = 'vegetale'
        AND latino = nomeLatino);
	
    IF cont = 0 
    THEN  INSERT INTO SPECIE(nomeLatino, tipo, nomeItaliano, classe, annoClassif, vulnerabilita, wikiLink, cmAltezza, cmDiametro, peso, mediaProle)
    VALUE (latino, tipoS, italiano, class, annoC, vulnerabilita, wikiLink, altezza, diametro, weight, prole);
    END IF;
    
    END;

|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE inserisciSpecieFaunistica(IN latino VARCHAR(64), IN tipoS ENUM('animale'), IN italiano VARCHAR(64), IN class VARCHAR(64), IN annoC INT(11), IN vulnerabilita FLOAT, IN wikipedia VARCHAR(64), IN altezza INT(11), IN diametro INT(11), IN weight FLOAT, IN prole FLOAT)
/*Inserimento specie floristica*/
	BEGIN
    
    DECLARE  cont INT DEFAULT 0;
    
		SET  cont = (
        SELECT count(*) AS existsSpecie
        FROM SPECIE
        WHERE tipo = 'animale'
        AND latino = nomeLatino);
	
    IF cont = 0 
    THEN  INSERT INTO SPECIE(nomeLatino, tipo, nomeItaliano, classe, annoClassif, vulnerabilita, wikiLink, cmAltezza, cmDiametro, peso, mediaProle)
    VALUE (latino, tipoS, italiano, class, annoC, vulnerabilita, wikiLink, altezza, diametro, weight, prole);
    END IF;
    
    END;
    
|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE inserisciHabitat(IN idH TINYINT(4), IN descrizione VARCHAR(64))
	BEGIN
    
    DECLARE cont INT DEFAULT 0;

		SET  cont = (
        SELECT count(*) AS existsHabitat
        FROM HABITAT
        WHERE  idH = id);
    
    IF cont = 0 
    THEN  INSERT INTO HABITAT(id, descrizione)
    VALUE (idH, descrizione);
    END IF;        
    
    END;
    
|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE updateSpecie(IN latino VARCHAR(64), IN tipoS ENUM('vegetale','animale'), IN italiano VARCHAR(64), IN class VARCHAR(64), IN annoC INT(11), IN vulnerabilita FLOAT, IN wikipedia VARCHAR(64), IN altezza INT(11), IN diametro INT(11), IN weight FLOAT, IN prole FLOAT)
	BEGIN
    
    IF EXISTS(SELECT *
						FROM SPECIE
                        WHERE latino = nomeLatino)
    THEN UPDATE SPECIE
    SET tipo = tipoS, nomeItaliano = italiano, classe = class, annoClassificazione = annoC , old.vulnerabilita = vulnerabilita, old.wikiLink = wikiLink, cmAltezza = altezza, cmDiametro = diametro, peso = wheight, mediaProle = prole
    WHERE latino = nomeLatino;
    END IF;
   
   END;

|
DELIMITER ;

DELIMITER |
CREATE PROCEDURE updateHabitat(IN idH TINYINT(4), IN descrizione VARCHAR(64))
	BEGIN
    
    IF EXISTS(SELECT *
						FROM HABITAT
                        WHERE id = idH)
    THEN UPDATE HABITAT
    SET old.descrizione = descrizione
    WHERE id = idH;
    END IF;
   
   END;

|
DELIMITER ;


DELIMITER |
CREATE PROCEDURE inserisciRF(IN idPR TINYINT(4), IN descrizione VARCHAR(500), IN maxImporto FLOAT)
	BEGIN
    
    DECLARE cont INT DEFAULT 0;

		SET  cont = (
        SELECT count(*) AS existsRaccolta
        FROM RACCOLTAFONDI
        WHERE  idPR = id2);
    
    IF cont = 0 
    THEN  INSERT INTO RACCOLTAFONDI(id2, inizio, descrizione, maxImporto)
    VALUE (idPR, CURDATE(), descrizione, maxImporto);
    END IF;        
    
    END;
    
|
DELIMITER ;
/*SCHELETRO PROCEDURE
DELIMITER |
CREATE PROCEDURE nomeProcedura()
	BEGIN
    
    
    END;

|
DELIMITER ;
*/