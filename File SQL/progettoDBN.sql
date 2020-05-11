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
/* Aggiungi utente semplice. */
DELIMITER |
CREATE PROCEDURE AggiungiUtente(IN emailU VARCHAR(64), IN pswU VARCHAR(32), IN nomeU VARCHAR(64), IN cognomeU VARCHAR(64), IN dataU DATE, IN luogoU VARCHAR(64))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
	/* Inizializzo variabile cont. */
	SET cont = (
		SELECT COUNT(*)
		FROM UTENTE
		WHERE email = emailU
    );
    
    IF cont < 1 THEN
		INSERT INTO UTENTE VALUES(emailU, pswU, nomeU, cognomeU, dataU, luogoU);
		INSERT INTO SEMPLICE VALUES(emailU);
	END IF;
    
	END;
|
DELIMITER ;

/* Aggiungi utente dipendente. */
DELIMITER |
CREATE PROCEDURE AggiungiUtenteDipendente(IN emailU VARCHAR(64), IN pswU VARCHAR(32), IN nomeU VARCHAR(64), IN cognomeU VARCHAR(64), IN dataU DATE, IN luogoU VARCHAR(64), IN nomeAziendaU VARCHAR(64), IN indirizzoAziendaU VARCHAR(64), IN telefonoU DECIMAL(10,0), IN telResponsabileU DECIMAL(10,0))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    DECLARE isExist INT DEFAULT 0;
    
	/* Inizializzo variabile cont e verifico se l'utente esiste già */
	SET cont = (
		SELECT COUNT(*)
		FROM UTENTE
		WHERE email = emailU
    );
    /* Controllo se l'azienda esiste, se no la creo */
    SET isExist = (
		SELECT COUNT(*)
		FROM AZIENDA
		WHERE nome = nomeAziendaU
    );
   
    /* Se l'utente non esiste, allora faccio il controllo anche della azienda, se non esiste la creo */
	IF cont < 1 
	THEN
		/* Se esiste l'azienda entro */
     	IF isExist > 0
		THEN
			INSERT INTO UTENTE VALUES(emailU, pswU, nomeU, cognomeU, dataU, luogoU);
			INSERT INTO DIPENDENTE VALUES(emailU, nomeAziendaU);
		ELSE
			INSERT INTO AZIENDA VALUES(nomeAziendaU, indirizzoAziendaU, telefonoU, telResponsabileU);
			INSERT INTO UTENTE VALUES(emailU, pswU, nomeU, cognomeU, dataU, luogoU);
			INSERT INTO DIPENDENTE VALUES(emailU, nomeAziendaU);
		END IF;
	END IF;
	END;
|
DELIMITER ;

/* Eliminazione utente. */
DELIMITER |
CREATE PROCEDURE EliminaUtente(IN emailUtente VARCHAR(64))
	BEGIN
	DELETE FROM UTENTE
	WHERE email = emailUtente;
	END;
|
DELIMITER ;

/* Eliminazione foto. */
DELIMITER |
CREATE PROCEDURE EliminaFoto(IN emailUtente VARCHAR(64), IN idFoto VARCHAR(64))
	BEGIN
	DELETE FROM UTENTE
	WHERE email = emailUtente AND id = idFoto;
	END;
|
DELIMITER ;

/* Aggiungi foto. */
DELIMITER |
CREATE PROCEDURE AggiungiFoto(IN emailUtente VARCHAR(64), IN idFoto VARCHAR(64))
	BEGIN
	INSERT INTO FOTO VALUES (emailUtente, idFoto);
	END;
|
DELIMITER ;

DROP PROCEDURE IF EXISTS AggiungiPrenotazione;
/* Aggiungi prenotazione. */
DELIMITER |
CREATE PROCEDURE AggiungiPrenotazione(IN dataPrenotazione DATE, IN inizio TIME, IN fine TIME, IN note VARCHAR(500), IN idTappaP NUMERIC, IN idTappaA NUMERIC, IN targa VARCHAR(10), IN idAreaP NUMERIC, IN idAreaA NUMERIC, IN emailUtente VARCHAR(64)) #, OUT msg VARCHAR(50))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    DECLARE idKm INT DEFAULT 0;
    DECLARE idTragitto INT;
    DECLARE checkVeicolo INT DEFAULT 0;
    
	/* Controllo se la prenotazione esiste. */
	SET cont = (
		SELECT COUNT(*) AS existPren
		FROM PRENOTAZIONE AS P
		WHERE data = dataPrenotazione
        AND oraInizio = inizio
        AND oraFine = fine
        AND idTappaPartenza = idTappaP
        AND idTappaArrivo = idTappaA
        AND targaVeicolo = targa
        AND idAreaPartenza = idAreaP
        AND idAreaArrivo = idAreaA
        AND stato = 'APERTA'
    );
    
    /* Controllo se la vettura è disponibile. */
    SET checkVeicolo = (
		SELECT COUNT(*) as existVeic
        FROM PRENOTAZIONE AS P
        WHERE targaVeicolo = targa
        AND oraFine < inizio
        AND oraInizio > fine
        AND data = dataPrenotazione
    );
    
    IF checkVeicolo = 0 #Se il veicolo non è presente come orario allora entro nel ciclo
    THEN
		IF cont = 0 #Se la prenotazione non esiste ancora entro nel ciclo
		THEN
			SET idKm = FLOOR(1 + RAND()*100);
			INSERT INTO TRAGITTO(puntoA, puntoB, numKmPrev, tipologia) VALUES
			(idTappaP, idTappaA, idKm, 'misto');
			# Trovo il tragitto sopra creato per aggiungerlo alla nuova prenotazione
			SET idTragitto = (
				SELECT id
                FROM TRAGITTO
                WHERE puntoA = idTappaP
                AND puntoB = idTappaA
                AND numKmPrev = idKm
                AND tipologia = 'misto'
            );
			INSERT INTO PRENOTAZIONE(data, oraInizio, oraFine, note, idTappaPartenza, idTappaArrivo, targaVeicolo, idAreaPartenza, idAreaArrivo, emailUtente, idTragitto) VALUES 
			(dataPrenotazione, inizio, fine, note, idTappaP, idTappaA, targa, idAreaP, idAreaA, emailUtente, idTragitto);
		END IF;
	#ELSE
    #SET msg = 'Vettura gia in utilizzo in altre prenotazioni';
    END IF;
    
	END;
|
DELIMITER ;

/* Elimina prenotazione. */
DELIMITER |
CREATE PROCEDURE EliminaPrenotazione(IN codP TINYINT)#, OUT msg VARCHAR(50))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
	/* Controllo se la prenotazione esiste, ma che non sia nelle due condivisioni. */
	SET cont = (
		SELECT COUNT(*) AS existPren
		FROM PRENOTAZIONE
		WHERE cod = codP
        AND cod NOT IN(
			SELECT cod
			FROM condivisionep AS P, PRENOTAZIONE AS PR
			WHERE P.codPrenotazione = PR.cod
			AND P.emailPremium = PR.emailUtente
			AND P.targaVeicolo = PR.targaVeicolo
            )
		AND cod NOT IN(
			SELECT cod
			FROM condivisioned AS D, PRENOTAZIONE AS PR
			WHERE D.codPrenotazione = PR.cod
			AND D.emailDipendente = PR.emailUtente
			AND D.targaVeicolo = PR.targaVeicolo
            )
    );
    
    IF cont > 0 THEN
		DELETE FROM PRENOTAZIONE WHERE cod = codP;
	END IF;
    
	END;
|
DELIMITER ;

/* Condividi prenotazioneP. */
DELIMITER |
CREATE PROCEDURE CondividiPrenotazioneP(IN emailP VARCHAR(64), IN emailPartecipante VARCHAR(64), IN codP TINYINT, IN idTappaPV TINYINT, IN idTappaAV TINYINT, IN spesaT DECIMAL(10,2), IN targaV VARCHAR(10))#, OUT msg VARCHAR(50))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
	/* Inizializzo variabile contPrenotazioni. */
	SET cont = (
		SELECT COUNT(*) AS existPren
		FROM CONDIVISIONEP
		WHERE codPrenotazione = codP
    );
    
    IF cont <= 0 THEN
		#SET msg = 'Prenotazione già condivisa!';
	#ELSE
		INSERT INTO CONDIVISIONEP VALUES (emailP, emailPartecipante, codP, idTappaPV, idTappaAV, spesaT, targaV);
		#SET msg = 'Prenotazione condivisa correttamente.';
	END IF;
    
	END;
|
DELIMITER ;

/* Condividi prenotazioneD. */
DELIMITER |
CREATE PROCEDURE CondividiPrenotazioneD(IN emailD VARCHAR(64), IN emailPartecipante VARCHAR(64), IN codP TINYINT, IN idTappaPV TINYINT, IN idTappaAV TINYINT, IN spesaT DECIMAL(10,2), IN targaV VARCHAR(10))#, OUT msg VARCHAR(50))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
	/* Inizializzo variabile contPrenotazioni */
	SET cont = (
		SELECT COUNT(*) AS existPren
		FROM CondivisioneD
		WHERE codPrenotazione = codP
    );
    
    IF cont <= 0 THEN
		#SET msg = 'Prenotazione già condivisa!';
	#ELSE
		INSERT INTO CONDIVISIONED VALUES (emailD, emailPartecipante, codP, idTappaPV, idTappaAV, spesaT, targaV);
		#SET msg = 'Prenotazione condivisa correttamente.';
	END IF;
    
	END;
|
DELIMITER ;

/* Elimina condivisioneD. */
DELIMITER |
CREATE PROCEDURE EliminaCondivisioneD(IN codP TINYINT)
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
	/* Inizializzo variabile contPrenotazioni */
	SET cont = (
		SELECT COUNT(*) AS existPren
		FROM CONDIVISIONED
		WHERE codPrenotazione = codP
    );
    
    IF cont > 0 THEN
		DELETE FROM CONDIVISIONED WHERE codPrenotazione = codP;
	END IF;
    
	END;
|
DELIMITER ;

/* Elimina condivisioneP. */
DELIMITER |
CREATE PROCEDURE EliminaCondivisioneP(IN codP TINYINT)
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
	/* Inizializzo variabile contPrenotazioni */
	SET cont = (
		SELECT COUNT(*) AS existPren
		FROM CONDIVISIONEP
		WHERE codPrenotazione = codP
    );
    
    IF cont > 0 THEN
		DELETE FROM CONDIVISIONEP WHERE codPrenotazione = codP;
	END IF;
    
	END;
|
DELIMITER ;


/* Elimina partecipazione. */
DELIMITER |
CREATE PROCEDURE EliminaPartecipazione(IN codP TINYINT, IN emailP VARCHAR(64))
	BEGIN
    DECLARE cont1 INT DEFAULT 0;
    DECLARE cont2 INT DEFAULT 0;
    
	/* Inizializzo variabile contPrenotazioni */
	SET cont1 = (
		SELECT COUNT(*) AS existPren
		FROM CONDIVISIONED AS D
		WHERE D.codPrenotazione = codP
    );
    
	/* Inizializzo variabile contPrenotazioni */
	SET cont2 = (
		SELECT COUNT(*) AS existPren
		FROM CONDIVISIONEP AS P
		WHERE P.codPrenotazione = codP
    );
    
    IF cont1 > 0 THEN
		DELETE
        FROM CONDIVISIONED
        WHERE codPrenotazione = codP
        AND emailPartecipante = emailP;
	END IF;
    
    IF cont2 > 0 THEN
		DELETE
        FROM CONDIVISIONEP
        WHERE codPrenotazione = codP
        AND emailPartecipante = emailP;
	END IF;
    
	END;
|
DELIMITER ;


/* Agguiungi una valutazione utente. */
DELIMITER |
CREATE PROCEDURE AggiungiValutazione(IN dataV DATE, IN testoV VARCHAR(500), IN votoV TINYINT(4), IN idTragittoV TINYINT(4), IN emailPremiumV VARCHAR(64), IN emailUtenteV VARCHAR(64))
	BEGIN
		INSERT INTO VALUTAZIONE(data, testo, voto, idTragitto, emailPremium, emailUtente) VALUES (dataV, testoV, votoV, idTragittoV, emailPremiumV, emailUtenteV);
	END
|
DELIMITER ;

/* Agguiungi una condivisione Premium. */
DELIMITER |
CREATE PROCEDURE AggiungiCondivisioneP(IN emailPartecipante VARCHAR(64), IN codP TINYINT, IN idTappaPV TINYINT, IN idTappaAV TINYINT, IN spesaT DECIMAL(10,2), IN targaV VARCHAR(10))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    DECLARE emailCondivisore VARCHAR(64);
    
		/* Controllo se la prenotazione esiste ed è aperta. */
    	SET cont = (
			SELECT COUNT(*) AS existPren
			FROM PRENOTAZIONE
			WHERE cod = codP
			AND stato = 'APERTA'
    );
    
    IF cont = 1
    THEN
		/* Controllo chi ha condiviso la prenotazione. */
		SET emailCondivisore = (
			SELECT emailUtente
			FROM PRENOTAZIONE
			WHERE cod = codP
		);
        
		IF emailCondivisore <> emailPartecipante 
		THEN
			INSERT INTO CONDIVISIONEP VALUES (emailCondivisore, emailPartecipante, codP, idTappaPV, idTappaAV, spesaT, targaV);
		END IF;
    END IF;
	END;
|
DELIMITER ;

/* Agguiungi una condivisione Dipendente. */
DELIMITER |
CREATE PROCEDURE AggiungiCondivisioneD(IN emailPartecipante VARCHAR(64), IN codP TINYINT, IN idTappaPV TINYINT, IN idTappaAV TINYINT, IN spesaT DECIMAL(10,2), IN targaV VARCHAR(10))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    DECLARE emailCondivisore VARCHAR(64);
    
		/* Controllo se la prenotazione esiste ed è aperta. */
    	SET cont = (
			SELECT COUNT(*) AS existPren
			FROM PRENOTAZIONE
			WHERE cod = codP
            AND stato = 'APERTA'
    );
    
    IF cont = 1 THEN
		/* Controllo chi ha condiviso la prenotazione. */
		SET emailCondivisore = (
			SELECT emailUtente
			FROM PRENOTAZIONE
			WHERE cod = codP
		);
        
		IF emailCondivisore <> emailPartecipante THEN
			INSERT INTO CONDIVISIONED VALUES (emailCondivisore, emailPartecipante, codP, idTappaPV, idTappaAV, spesaT, targaV);
		END IF;
    END IF;
	END;
|
DELIMITER ;

/* Agguiungi una segnalazione UTENTE. */
DELIMITER |
CREATE PROCEDURE AggiungiSegnalazioneU(IN titoloU VARCHAR(64), IN testoU VARCHAR(500), IN emailUtenteU VARCHAR(64), IN targaU VARCHAR(10))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
    /* Controllo se la segnalazione esiste già. */
    	SET cont = (
			SELECT COUNT(*) AS existSegn
			FROM SEGNALAZIONE
			WHERE titolo = titoloU
            AND testo = testoU
            AND emailUtente = emailUtenteU
            AND targaVeicolo = targaU
    );
    
    IF cont = 0
    THEN
		INSERT INTO SEGNALAZIONE(data, titolo, testo, emailUtente, targaVeicolo) VALUES
        (CURDATE(), titoloU, testoU, emailUtenteU, targaU);
    END IF;
    
	END;
|
DELIMITER ;


/* Agguiungi una segnalazione SOCIETA'. */
DELIMITER |
CREATE PROCEDURE AggiungiSegnalazioneS(IN titoloS VARCHAR(64), IN testoS VARCHAR(500), IN nomeSocietaS VARCHAR(64), IN targaS VARCHAR(10))
	BEGIN
    DECLARE cont INT DEFAULT 0;
    
    /* Controllo se la segnalazione esiste già. */
    	SET cont = (
			SELECT COUNT(*) AS existSegn
			FROM SEGNALAZIONE
			WHERE titolo = titoloS
            AND testo = testoS
            AND emailUtente = nomeSocietaS
            AND targaVeicolo = targaS
    );
    
    IF cont = 0
    THEN
		INSERT INTO SEGNALAZIONE(data, titolo, testo, nomeSocieta, targaVeicolo) VALUES
        (CURDATE(), titoloS, testoS, nomeSocietaS, targaS);
    END IF;
    
	END;
|
DELIMITER ;

