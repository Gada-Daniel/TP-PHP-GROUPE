DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `naissance` date NOT NULL,
  `telephone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `utilisateur` (`id_user`, `prenom`, `nom`, `naissance`, `telephone`, `email`, `password`, `created_at`) VALUES
(9, 'Augustin', 'd\'Erceville', '2000-09-22', '0782706356', 'a.erceville2000@gmail.com', '$2y$10$QxUyyzmnwtEH3KSLmz/7ROQ4JmsH33u4CfJkYiPHVwdJZJdSogobG', '2024-12-10 16:14:51'),
(10, 'Augustin', 'Rolland de Chambaudoin d\'Erceville', '2000-09-22', '0782706356', 'a.erceville@lprs.fr', '$2y$10$6DkhPsde1ghRaFfYfwW4l.CMcCsnZOxahNCP.WWlcFGgy6KH5k.Re', '2024-12-10 16:23:15');
COMMIT;
