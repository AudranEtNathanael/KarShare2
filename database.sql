drop table jabaianb.reservation ;
drop table jabaianb.voyage ;
drop table jabaianb.trajet ;
drop table jabaianb.utilisateur ;

CREATE TABLE jabaianb.utilisateur (
 id SERIAL ,
 identifiant VARCHAR(45) NULL ,
 pass VARCHAR(45) NULL ,
 nom VARCHAR(45) NULL ,
 prenom VARCHAR(45) NULL ,
 avatar VARCHAR(200) NULL ,
 PRIMARY KEY (id) );


CREATE TABLE jabaianb.trajet (
 id SERIAL ,
 depart VARCHAR(25) NULL ,
 arrivee VARCHAR(25) NULL ,
 distance INT NULL , 
 PRIMARY KEY (id) );


CREATE TABLE jabaianb.voyage (
 id SERIAL ,
 conducteur INT NULL ,
 trajet INT NULL ,
 tarif INT NULL , 
 nbPlace INT NULL ,
 heureDepart INT NULL ,
 contraintes VARCHAR(500),	 
 PRIMARY KEY (id) ,
 CONSTRAINT utilisateur
 FOREIGN KEY (conducteur)
 REFERENCES jabaianb.utilisateur (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION,
 CONSTRAINT trajet
 FOREIGN KEY (trajet)
 REFERENCES jabaianb.trajet (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION);

CREATE TABLE jabaianb.reservation (
 id SERIAL ,
 voyage INT NULL ,
 voyageur INT NULL ,
 PRIMARY KEY (id) ,
 CONSTRAINT utilisateur
 FOREIGN KEY (voyageur)
 REFERENCES jabaianb.utilisateur (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION,
 CONSTRAINT voyage
 FOREIGN KEY (voyage)
 REFERENCES jabaianb.voyage (id )
 ON DELETE NO ACTION
 ON UPDATE NO ACTION);
  
