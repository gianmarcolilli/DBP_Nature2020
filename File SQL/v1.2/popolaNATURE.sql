
insert into NATURE.raccoltafondi (inizio,descrizione,maxImporto) values 
('2005-12-11', 'la raccolta e per noi', '1200'),
('2006-11-23','questa raccolta è per te','2500'),
('2020-11-21','questa raccolta è per i bambini','30000');

insert into NATURE.utente (nomeUtente, tipo, psw, email, annoNascita, dataRegistrazione, professione, classifCorrette, classifNonCorrette, classifTotali, affidabilita, contatore ) values 
('mike32', 'semplice', 'dfsvfrbveg56','mike32@gmail.com','1985','2018-03-21','avvocato','2','3','5','2','1'),
('giovanni3', 'premium', 'gio324qw','giovannitremari@gmail.com','1994','2020-03-23','studente','1','3','4','2','1'),
('gian', 'amministratore', 'g','gianroma@gmail.com','1993','2020-03-23','studente','1','3','4','2','1'),
('bobo43', 'amministratore', 'dsevni76','bobo43@gmail.com','1987','2019-03-12','operaio','1','3','4','2','1');

insert into NATURE.habitat (nome) values
("habitat dell'uccello"),
("habitat del leone"),
("habitat dell'iris"),
("foresta conifere");

insert into NATURE.specie values
('ibiscus','vegetale','iris','2','1932','50','www.wikipedia/iris.it','43','12','21','2.3','foresta conifere'),
('picchio','animale','pictorius uccellus','2','1945','23','www.wikipedia/picchio.it','10','12','32','3.3','foresta conifere');

insert into NATURE.escursione (titolo, dataEscursione, oraPartenza, oraRitorno, descrizione, maxPartecipanti) values
('gita al lago', '2012-03-12', '12:00', '18:00', 'la gita si svolgerà con i scarponi da montagna', '23'),
('gita al mare', '2012-03-10', '13:00', '20:00', 'la gita si svolgerà con il costume da mare', '10');



#insert into NATURE.messaggio (nomeUtenteMittente, nomeUtenteDestinatario, titolo, testo) values
#('mike32', 'giovanni3', 'saluti', 'ciao gio ti saluto'),
#( 'giovanni3','mike32', 'ringraziamenti', 'ciao mike ti ringrazio');

insert into NATURE.proposta (commento, dataProposta) values
('proposta numero 1', '2020-12-23'),
('proposta numero 2', '2020-12-30');

insert into NATURE.segnalazione (nomeUtente,dataSegnalazione,latitudineGPS,longitudineGPS) values
('mike32','2020-03-20','90','75'),
('mike32','2020-01-20','90','75'),
('mike32','2020-02-20','90','75');

insert into NATURE.adesione values
('1', 'mike32', '1200', 'ok'),
('2', 'gian', '1200', 'ok'),
('2', 'bobo43', '1400', 'ok');