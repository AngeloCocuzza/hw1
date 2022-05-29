
create database sicilytravel;
use sicilytravel;
CREATE TABLE users (
    id integer primary key auto_increment,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    lastname varchar(255) not null
) Engine = InnoDB;



CREATE TABLE pacchetti (
    id integer primary key auto_increment,
    destinazione_tour varchar(255) not null,
    ora_partenza varchar(255) not null,
    prezzo float not null,
    giorno varchar(255) not null,
    descrizione varchar(255)
) Engine = InnoDB;

CREATE TABLE carrello (
    id integer primary key auto_increment,
    user integer not null,
    pacchetti_c integer not null,
    index xuser(user),
    index xpacchetti(pacchetti_c),
    foreign key(user) references users(id),
    foreign key(pacchetti_c) references pacchetti(id)
) Engine = InnoDB;

CREATE TABLE citta (
    id integer primary key auto_increment,
    titolo varchar(255),
    descrizione varchar(255),
    img varchar(255),
    link varchar(255)
    
);
CREATE TABLE recensioni (
   id integer primary key auto_increment ,
    voto int NOT NULL ,
    id_recensore int  , 
    titolo varchar(100) NOT NULL  ,
    recensione varchar(1500) NOT NULL,
    utente varchar(40) NOT NULL);


INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno,descrizione) VALUES ('Catania', '09:00', '20', '6-6-2022',"In questo caso risparmierai anche il biglietto per spostarti,il nostro tour comprende una visita al meraviglioso palazzo Biscari ,vi faremo ammirare la citta dall'alto da una cupola mozzafiato e moltro altro ancora");
INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno,descrizione) VALUES ('Palermo', '07:00', '35', '9-6-2022',"Naturalmente non poteva mancare il capoluogo di questa fantastica regione,qui il nostro tour comprende una visita alla cattedrale,al suggestivo mercato di ballaro',il teatro Massimo ,il palazzo dei Normanni e non e' finita qui...");
INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno,descrizione) VALUES ('Siracusa', '8:00', '29', '11-6-2022',"Tour diSiracusa e l'affascinante isola di Ortigia.Le principali tappe della citta di siracusa saranno il parco archeologico della Neapolis , il teatro Greco e l'Orecchio di Dionisio e finiremo il tour con la visita all'isola di Ortigia.");
INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno,descrizione) VALUES ('Noto-Modica-Ragusa', '07:15', '25', '12-6-2022',"Le citta' Barocche di Noto, Modica e Ragusa sono tutte presenti nell'elenco dei patrimoni dell'umanita' dell'UNESCO.Tutto quello che dovrete fare e' semplicemente passeggiare tra i centri storici di queste citta' e divertirvi!");
INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno,descrizione) VALUES ('Taormina', '8:30', '28', '15-6-2022',"Taormina e' una delle localita' turistiche piu' famose dell'isola.Tra le visite ci saranno sicuramente il teatro Greco di Taormina,la villa comunale e il suggestivo duomo,per poi concludere la giornata con un po di relax a Giardini-Naxos");
INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno,descrizione) VALUES ('Agrigento', '07:45', '32', '19-6-2022',"La Valle dei Templi, nei pressi della citta' di Agrigento, e' il sito archeologico piu' famoso della Sicilia.Nella valle sono presenti 8 templi  visitabili,inoltre il tour comprende  la suggestiva scala dei turchi a pochi km di distanza.");
INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno),descrizione VALUES ('Isole Eolie', '06:45', '59', '21-6-2022'," Tra le cose da vedere in Sicilia troviamo sicuramente questo arcipelago vulcanico formato da 7 isole + qualche altra isoletta e roccia. Le piu' famose e quindi piu' visitate sono Lipari, Salina, Vulcano e Stromboli.");
INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno,descrizione) VALUES ('Trapani', '07:00', '39', '24-6-2022',"La citta' di Trapani di per se' non e' un importante punto di interesse del turismo Siciliano, ma rappresenta comunque il punto di partenza ideale per almeno 2 attrazioni principali:Il tempio di Segesta e il borgo medievale di Erice");
INSERT INTO pacchetti(destinazione_tour,ora_partenza,prezzo,giorno,descrizione) VALUES ('Isole Egadi', '06:45', '48', '25-6-2022',"Vicino a Trapani, si trovano le Isole Egadi, una delle mete piu' interessanti del turismo in Sicilia.Le 3 Isole Egadi sono Favignana, Levanzo e Marettimo ");


INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Catania','Tour guidato di Catania a soli 22€','images/catania.jpg','Scopri il tour completo');
INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Palermo','Tour guidato di Palermo a soli 35€','images/palermo.jpg','Scopri il tour completo');
INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Siracusa e isola di Ortigia','Tour guidato di Siracusa a soli 29€','images/siracusa.jpg','Scopri il tour completo');
INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Noto','Tour guidato di Noto Modica e Ragusa a soli 25€ ','images/noto.jpg','Scopri il tour completo');
INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Taormina','Tour guidato di Taormina e Giardini Naxos a soli 28€','images/taormina.jpg','Scopri il tour completo');
INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Valle dei templi', 'Tour guidato Scala dei Turchi e Valle dei Templi a soli 32€','images/valle_dei_templi_agrigento.jpg','Scopri il tour completo');
INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Isole Eolie','Tour guidato delle isole eolie a soli 59€','images/Isole_Eolie.jpg','Scopri il tour completo');
INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Trapani ,Erice e i templi di Segesta','Tour guidato di Trapani a soli 39€','images/trapani.jpg','Scopri il tour completo ');
INSERT INTO citta(titolo,descrizione,img,link) VALUES ('Isole Egadi','Tour guidato delle isole Egadi a soli 48€','images/isole-egadi.jpg','Scopri il tour completo');

