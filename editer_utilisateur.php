<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_user'])) {
    die("ID utilisateur manquant.");
}
$id_user = intval($_POST['id_user']);
try {
    $bdd = new PDO('mysql:host=localhost;dbname=tp_crud;charset=utf8mb4', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
try {
    $req = $bdd->prepare("SELECT * FROM utilisateur WHERE id_user = :id_user");
    $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $req->execute();
    $utilisateur = $req->fetch(PDO::FETCH_ASSOC);

    if (!$utilisateur) {
        die("Utilisateur non trouvé.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $naissance = $_POST['naissance'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];

    try {
        $update = $bdd->prepare("
            UPDATE utilisateur 
            SET prenom = :prenom, nom = :nom, naissance = :naissance, telephone = :telephone, email = :email 
            WHERE id_user = :id_user
        ");
        $update->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $update->bindParam(':nom', $nom, PDO::PARAM_STR);
        $update->bindParam(':naissance', $naissance, PDO::PARAM_STR);
        $update->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $update->bindParam(':email', $email, PDO::PARAM_STR);
        $update->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $update->execute();

        echo "<script>alert('Utilisateur mis à jour avec succès !');</script>";
        echo "<script>window.location.href = 'index.php';</script>"; // Redirection vers la page principale
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer utilisateur</title>
</head>
<body>
<h1>Éditer l'utilisateur</h1>
<form method="POST" action="">
    <input type="hidden" name="id_user" value="<?= $id_user; ?>">
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur['prenom']); ?>" required>
    <br>

    <label for="nom">Nom de famille :</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur['nom']); ?>" required>
    <br>

    <label for="naissance">Date de naissance :</label>
    <input type="date" id="naissance" name="naissance" value="<?= htmlspecialchars($utilisateur['naissance']); ?>" required>
    <br>

    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($utilisateur['telephone']); ?>" required>
    <br>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['email']); ?>" required>
    <br>

    <button type="submit" name="modifier">Enregistrer les modifications</button>
</form>
<a href="index.php">Annuler</a>
</body>
</html>
