
CREATE TABLE Utilisateur (
                identifiant VARCHAR(45) NOT NULL,
                motdepasse VARCHAR(100) NOT NULL,
                nom VARCHAR(45) NOT NULL,
                prenom VARCHAR(45) NOT NULL,
                email VARCHAR(45) NOT NULL,
                role BOOLEAN,
                PRIMARY KEY (identifiant)
);


CREATE TABLE Commentaire (
                idCommentaire INT AUTO_INCREMENT NOT NULL,
                identifiant VARCHAR(45) NOT NULL,
                auteur VARCHAR(45) NOT NULL,
                contenu TEXT NOT NULL,
                date DATE NOT NULL,
                estValide BOOLEAN,
                PRIMARY KEY (idCommentaire, identifiant)
);


CREATE TABLE Article (
                idArticle INT AUTO_INCREMENT NOT NULL,
                identifiant VARCHAR(45) NOT NULL,
                idCommentaire INT NOT NULL,
                auteur VARCHAR(45) NOT NULL,
                contenu TEXT NOT NULL,
                date DATE NOT NULL,
                titre VARCHAR(300) NOT NULL,
                chapo VARCHAR(300) NOT NULL,
                PRIMARY KEY (idArticle, identifiant, idCommentaire)
);


ALTER TABLE Commentaire ADD CONSTRAINT utilisateur_commentaire_fk
FOREIGN KEY (identifiant)
REFERENCES Utilisateur (identifiant)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Article ADD CONSTRAINT utilisateur_article_fk
FOREIGN KEY (identifiant)
REFERENCES Utilisateur (identifiant)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Article ADD CONSTRAINT commentaire_article_fk
FOREIGN KEY (idCommentaire, identifiant)
REFERENCES Commentaire (idCommentaire, identifiant)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
