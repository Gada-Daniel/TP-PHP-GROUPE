-- Table : Citoyens
CREATE TABLE IF NOT EXISTS Citoyens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    telephone VARCHAR(15) UNIQUE NOT NULL
)ENGINE=InnoDB;

-- Table : RendezVous
CREATE TABLE IF NOT EXISTS RendezVous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    citoyen_id INT NOT NULL,
    date_heure DATETIME NOT NULL,
    lieu VARCHAR(255) NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    statut ENUM('A Venir', 'Annulé', 'Effectué') DEFAULT 'A Venir',
    FOREIGN KEY (citoyen_id) REFERENCES Citoyens(id) ON DELETE CASCADE
)ENGINE=InnoDB;