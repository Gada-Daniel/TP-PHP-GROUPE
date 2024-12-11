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
    <script>
        function supprimerUtilisateur(id) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
                fetch(`supprimer_utilisateur.php?id=${id}`, {
                    method: 'POST'
                })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload(); // Recharge la page après suppression
                    })
                    .catch(error => {
                        console.error("Erreur :", error);
                        alert("Erreur lors de la suppression.");
                    });
            }
        }
    </script>
</head>
<body>
<h1 style="text-transform: uppercase">Accueil</h1><p></p>
<a href="Inscription.php">INSCRIPTION</a><br>
<a href="connexion.php">CONNEXION</a><p></p>
<table>
    <thead>
    <tr>
        <th>Prénom</th>
        <th>Nom de famille</th>
        <th>Date naissance</th>
        <th>Numéro tel</th>
        <th>Email</th>
        <th>Inscription</th>
        <th>Actions</th>
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
                <td><?= htmlspecialchars($utilisateur['created_at']); ?></td>
                <td>
                    <button onclick="location.href='editer_utilisateur.php?id=<?= $utilisateur['id_user']; ?>'">Modifier</button>
                    <button onclick="location.href='supprimer_utilisateur.php?id=<?php $utilisateur['id_user']; ?>'">Supprimer</button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Aucun utilisateur trouvé.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
