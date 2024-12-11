<?php
if (isset($_POST['id_user'])) {
    $id = intval($_POST['id_user']);
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=tp_crud;charset=utf8', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $bdd->prepare("DELETE FROM utilisateur WHERE id_user = :id_user");
        $req->bindParam(':id_user', $id, PDO::PARAM_INT);
        $req->execute();
        echo "A plus l'utilisateur";
    } catch (PDOException $e) {
        echo "Sa a merdé " . $e->getMessage();
    }
} else {
    echo "PAS d'ID";
}
