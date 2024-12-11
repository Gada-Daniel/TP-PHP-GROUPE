<?php
include("config.php");
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['envoyer'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $req = $bdd->prepare('SELECT id_user, email, password FROM utilisateur WHERE email = :email');
        $req->execute(['email' => $email]);
        $user = $req->fetch();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['email'] = $user['email'];
                header('location:index.php');
                exit();
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
    } else {
        echo "Tous les champs doivent être remplis.";
    }
}
?>
<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Connexion</h1>
    <form action="" method="post">
        <label for="email">Adresse mail</label><br>
        <input type="email" name="email" id="email" required/><br>

        <label for="password">Mot de passe</label><br>
        <input type="password" name="password" id="password" required/><br><br>

        <input type="submit" name="envoyer" id="envoyer" value="Se connecter"/>
        <?php
        if (isset($message)) :
            ?>
            <?= $message ?><p></p>
        <?php endif; ?>
    </form>
    <p>
    Pas encore de compte ? <a href="Inscription.php">S'inscrire</a>
</div>
</body>
</html>
