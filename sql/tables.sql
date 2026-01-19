-- Ici les tables SQL de base pour la BDD.

-- -----------------------------------------------------
-- Table ADMINISTRATEUR
-- -----------------------------------------------------
CREATE TABLE ADMINISTRATEUR (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table EVENEMENT
-- -----------------------------------------------------
CREATE TABLE EVENEMENT (
    id_evenement INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    description TEXT,
    date_evenement DATE NOT NULL,
    heure TIME,
    lieu VARCHAR(150),
    type VARCHAR(50), -- atelier, anniversaire, spectacle, etc.
    image_url VARCHAR(255),
    mis_en_avant TINYINT(1) DEFAULT 0,
    statut VARCHAR(20) DEFAULT 'à venir',
    lien_programme_pdf VARCHAR(255),
    id_admin INT NOT NULL,
    CONSTRAINT fk_evenement_admin FOREIGN KEY (id_admin) REFERENCES ADMINISTRATEUR(id_admin)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table CRENEAU_HORAIRE
-- -----------------------------------------------------
CREATE TABLE CRENEAU_HORAIRE (
    id_creneau INT AUTO_INCREMENT PRIMARY KEY,
    date_creneau DATE NOT NULL,
    heure_debut TIME NOT NULL,
    heure_fin TIME NOT NULL,
    disponible TINYINT(1) DEFAULT 1,
    motif_blocage VARCHAR(255),
    id_admin INT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_creneau_admin FOREIGN KEY (id_admin) REFERENCES ADMINISTRATEUR(id_admin)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table PARTENAIRE
-- -----------------------------------------------------
CREATE TABLE PARTENAIRE (
    id_partenaire INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    logo_url VARCHAR(255),
    lien_externe VARCHAR(255),
    ordre_affichage INT DEFAULT 0,
    actif TINYINT(1) DEFAULT 1,
    id_admin INT NOT NULL,
    CONSTRAINT fk_partenaire_admin FOREIGN KEY (id_admin) REFERENCES ADMINISTRATEUR(id_admin)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table FICHIER
-- -----------------------------------------------------
CREATE TABLE FICHIER (
    id_fichier INT AUTO_INCREMENT PRIMARY KEY,
    nom_fichier VARCHAR(255) NOT NULL,
    chemin_fichier VARCHAR(255) NOT NULL,
    type_fichier VARCHAR(50), -- pdf, png, jpg...
    categorie VARCHAR(50), -- programme, legal, archive
    taille_ko INT,
    id_admin INT NOT NULL,
    date_upload DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_fichier_admin FOREIGN KEY (id_admin) REFERENCES ADMINISTRATEUR(id_admin)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table MESSAGE_CONTACT
-- -----------------------------------------------------
CREATE TABLE MESSAGE_CONTACT (
    id_message INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20),
    categorie VARCHAR(50), -- info, reservation, adhésion
    contenu TEXT NOT NULL,
    statut VARCHAR(20) DEFAULT 'en attente',
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_traitement DATETIME NULL,
    id_admin INT NULL, -- NULL tant qu'un admin ne l'a pas traité
    CONSTRAINT fk_message_admin FOREIGN KEY (id_admin) REFERENCES ADMINISTRATEUR(id_admin)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table RESERVATION
-- -----------------------------------------------------
CREATE TABLE RESERVATION (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telephone VARCHAR(20),
    type_reservation VARCHAR(50), -- Anniversaire, Location, Atelier
    date_souhaitee DATE,
    heure_debut TIME,
    heure_fin TIME,
    duree_heures INT,
    message TEXT,
    statut VARCHAR(20) DEFAULT 'en attente',
    nb_enfants INT DEFAULT 0,
    date_demande DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_traitement DATETIME NULL,
    id_admin INT NULL, -- NULL tant que pas validée/refusée
    id_evenement INT NULL, -- Lié si c'est un atelier/événement précis
    id_creneau INT NULL, -- Lié si c'est une location/anniversaire sur un créneau
    CONSTRAINT fk_res_admin FOREIGN KEY (id_admin) REFERENCES ADMINISTRATEUR(id_admin),
    CONSTRAINT fk_res_evenement FOREIGN KEY (id_evenement) REFERENCES EVENEMENT(id_evenement),
    CONSTRAINT fk_res_creneau FOREIGN KEY (id_creneau) REFERENCES CRENEAU_HORAIRE(id_creneau)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table NOTIFICATION_EMAIL
-- -----------------------------------------------------
CREATE TABLE NOTIFICATION_EMAIL (
    id_notification INT AUTO_INCREMENT PRIMARY KEY,
    type_notification VARCHAR(50), -- confirmation, rappel, annulation
    destinataire_email VARCHAR(100) NOT NULL,
    contenu TEXT,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP,
    envoye TINYINT(1) DEFAULT 0,
    id_reservation INT NOT NULL,
    CONSTRAINT fk_notif_reservation FOREIGN KEY (id_reservation) REFERENCES RESERVATION(id_reservation) ON DELETE CASCADE
) ENGINE=InnoDB;