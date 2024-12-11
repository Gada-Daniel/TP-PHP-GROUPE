<?php
function recuperation_utilisateur() {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=tp_crud;charset=utf8mb4', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $bdd->prepare("SELECT * FROM utilisateur");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_user'])) {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=tp_crud;charset=utf8mb4', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $req = $bdd->prepare("DELETE FROM utilisateur WHERE id_user = :id_user");
        $req->bindParam(':id_user', $_POST['id_user'], PDO::PARAM_INT);
        $req->execute();
        } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1 style="text-transform: uppercase">Accueil</h1>
<div class="btn-group" role="group" aria-label="Basic example">
<a href="Inscription.php" class="btn btn-outline-success">INSCRIPTION</a>
<a href="connexion.php" class="btn btn-outline-success">CONNEXION</a>
</div>
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
                    <form method="POST" action="">
                        <input type="hidden" name="id_user" value="<?= $utilisateur['id_user']; ?>">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            Supprimer
                        </button>
                    </form>
                    <form method="POST" action="editer_utilisateur.php" style="display: inline;">
                        <input type="hidden" name="id_user" value="<?= $utilisateur['id_user']; ?>">
                        <button type="submit">Éditer</button>
                    </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
