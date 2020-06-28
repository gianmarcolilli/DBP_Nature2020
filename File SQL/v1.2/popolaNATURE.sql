
insert into NATURE.progettoricerca (id) values
("1"),("2"),("3"),("4"),("5"),("6"),("7");

insert into NATURE.raccoltafondi (id2,inizio,descrizione,maxImporto) values
('2','2005-12-11', 'la raccolta e per noi', '1200'),
('4','2006-11-23','questa raccolta è per te','2500'),
('1','2006-11-03','questa raccolta è per il terremoto','50000'),
('6','2020-11-21','questa raccolta è per i bambini','30000');


insert into NATURE.utente (nomeUtente, tipo, psw, email, annoNascita, dataRegistrazione, professione, classifCorrette, classifNonCorrette, classifTotali, affidabilita, contatore ) values
('mike32', 'semplice', 'm','mike32@gmail.com','1985','2018-03-21','avvocato','2','3','5','2','1'),
('giovanni3', 'premium', 'giov','giovannitremari@gmail.com','1994','2020-03-23','studente','1','3','4','2','1'),
('gian', 'amministratore', 'g','gianroma@gmail.com','1993','2020-03-23','studente','1','3','4','2','1'),
('bobo43', 'amministratore', 'bobo','bobo43@gmail.com','1987','2019-03-12','operaio','1','3','4','2','1');

insert into NATURE.habitat (nome) values
("habitat dell'uccello"),
("habitat del leone"),
("habitat dell'iris"),
("colli euganei"),
("foresta conifere");

insert into NATURE.specie(nomeLatino, tipo, nomeItaliano, classe, annoClassif, vulnerabilita, wikiLink, nomeHabitat) values
('ibiscus','vegetale','iris','2','1932','50','www.wikipedia.it/iris','foresta conifere'),
('cipressus','vegetale','cipresso','4','1323','32','www.wikipedia.it/cipresso','colli euganei'),
('picchio','animale','pictorius uccellus','2','1945','23','www.wikipedia.it/picchio','foresta conifere');

insert into NATURE.escursione (titolo, dataEscursione, oraPartenza, oraRitorno, descrizione, maxPartecipanti) values
('gita al lago', '2012-03-12', '12:00', '18:00', 'la gita si svolgerà con i scarponi da montagna', '23'),
('gita al mare', '2012-03-10', '13:00', '20:00', 'la gita si svolgerà con il costume da mare', '10'),
('gita in laguna', '2012-07-13', '10:00', '18:00', 'la gita si svolgerà sul delta del po', '25');



#insert into NATURE.messaggio (nomeUtenteMittente, nomeUtenteDestinatario, titolo, testo) values
#('mike32', 'giovanni3', 'saluti', 'ciao gio ti saluto'),
#( 'giovanni3','mike32', 'ringraziamenti', 'ciao mike ti ringrazio');

insert into NATURE.segnalazione (nomeUtente,dataSegnalazione,latitudineGPS,longitudineGPS) values
('mike32','2020-03-20','90','75'),
('mike32','2020-01-25','50','25'),
('bobo43','2020-02-28','94','55'),
('giovanni3','2020-02-20','90','75');
insert into NATURE.proposta (id2,commento) values
('1','proposta numero 1'),
('4','proposta  2'),
('3','proposta in base al vento 3');



insert into NATURE.adesione values
('1', 'mike32', '1200', 'ok'),
('2', 'gian', '1200', 'ok'),
('2', 'bobo43', '1400', 'ok');
