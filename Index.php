<?php
function recuperation_utilisateur() {
    try {
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=tp_crud;charset=utf8', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $bdd->prepare("SELECT * FROM utilisateur");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
$utilisateurs = recuperation_utilisateur();
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1 style="text-transform: uppercase">Accueil</h1>
<table>
    <thead>
    <tr>
        <th>Prénom</th>
        <th>Nom de famille</th>
        <th>Date naissance</th>
        <th>Numéro tel</th>
        <th>Email</th>
        <th>Adresse</th>
        <th>Code postal</th>
        <th>Ville</th>
        <th>Pays</th>
        <th>Inscription</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($utilisateurs)): ?>
        <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <td><?= htmlspecialchars($utilisateur['prenom']); ?></td>
                <td><?= htmlspecialchars($utilisateur['nom']); ?></td>
                <td><?= htmlspecialchars($utilisateur['naissance']); ?></td>
                <td><?= htmlspecialchars($utilisateur['telephone']); ?></td>
                <td><?= htmlspecialchars($utilisateur['email']); ?></td>
                <td><?= htmlspecialchars($utilisateur['adresse']); ?></td>
                <td><?= htmlspecialchars($utilisateur['postal']); ?></td>
                <td><?= htmlspecialchars($utilisateur['ville']); ?></td>
                <td><?= htmlspecialchars($utilisateur['pays']); ?></td>
                <td><?= htmlspecialchars($utilisateur['created_at']); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="11">Aucun utilisateur trouvé.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
