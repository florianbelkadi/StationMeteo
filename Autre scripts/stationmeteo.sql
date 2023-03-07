CREATE TABLE NomCapteurs(
   Id_NomCapteurs INT AUTO_INCREMENT,
   NomCapteur VARCHAR(100) ,
   PRIMARY KEY(Id_NomCapteurs),
   UNIQUE(NomCapteur)
);

CREATE TABLE Villes(
   Id_Villes INT AUTO_INCREMENT,
   NomVille VARCHAR(50) ,
   PRIMARY KEY(Id_Villes),
   UNIQUE(NomVille)
);

CREATE TABLE TypeMeteos(
   Id_TypeMeteos INT AUTO_INCREMENT,
   NomTypeMeteo VARCHAR(50) ,
   PRIMARY KEY(Id_TypeMeteos),
   UNIQUE(NomTypeMeteo)
);

CREATE TABLE Donnees(
   Id_Donnees INT AUTO_INCREMENT,
   Temperature DECIMAL(5,2)  ,
   Humidite DECIMAL(4,2)  ,
   Pression DECIMAL(6,2)  ,
   DateDonnee DATETIME,
   Id_Villes INT,
   Id_TypeMeteos INT,
   Id_NomCapteurs INT,
   PRIMARY KEY(Id_Donnees),
   FOREIGN KEY(Id_Villes) REFERENCES Villes(Id_Villes),
   FOREIGN KEY(Id_TypeMeteos) REFERENCES TypeMeteos(Id_TypeMeteos),
   FOREIGN KEY(Id_NomCapteurs) REFERENCES NomCapteurs(Id_NomCapteurs)
);
