USE TouchePasAuKlaxon;

-- -----------------------------------------------------
-- DÉSACTIVATION DES VÉRIFICATIONS (performance)
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;
SET UNIQUE_CHECKS = 0;

-- -----------------------------------------------------
-- NETTOYAGE DES DONNÉES EXISTANTES
-- -----------------------------------------------------
TRUNCATE TABLE `trajets`;
TRUNCATE TABLE `users`;
TRUNCATE TABLE `agences`;

-- -----------------------------------------------------
-- INSERTION DES AGENCES
-- -----------------------------------------------------
INSERT INTO `agences` (`ville`) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- -----------------------------------------------------
-- INSERTION DES USERS // Password en clair temporairement
-- -----------------------------------------------------
INSERT INTO `users` (`nom`, `prenom`, `phone`, `email`, `role`, `password`) VALUES
('Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', 'user', 'Pass123!'),
('Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr', 'user', 'Pass123!'),
('Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr', 'user', 'Pass123!'),
('Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr', 'user', 'Pass123!'),
('Lefèvre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr', 'user', 'Pass123!'),
('Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr', 'user', 'Pass123!'),
('Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr', 'user', 'Pass123!'),
('Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr', 'user', 'Pass123!'),
('Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr', 'user', 'Pass123!'),
('Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr', 'user', 'Pass123!'),
('Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr', 'user', 'Pass123!'),
('Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr', 'user', 'Pass123!'),
('Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr', 'user', 'Pass123!'),
('Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr', 'user', 'Pass123!'),
('Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr', 'user', 'Pass123!'),
('Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr', 'user', 'Pass123!'),
('Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr', 'user', 'Pass123!'),
('Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr', 'user', 'Pass123!'),
('Masson', 'Julie', '0733445566', 'julie.masson@email.fr', 'user', 'Pass123!'),
('Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr', 'user', 'Pass123!'),

-- Ajout de l'utilisateur Admin
('Admin', 'System', '0000000000', 'admin@admin.com', 'admin', 'Pass123!');

-- -----------------------------------------------------
-- RÉACTIVATION DES VÉRIFICATIONS
-- -----------------------------------------------------
SET FOREIGN_KEY_CHECKS = 1;
SET UNIQUE_CHECKS = 1;