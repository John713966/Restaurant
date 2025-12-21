<?php
require("../BD/connexion.php");
if (isset($_POST['btnajouter'])) {
    $nomcategorie = htmlspecialchars($_POST['nomcategorie']);
    $stmt = $pdo->prepare("INSERT INTO categorie (nomcategorie) VALUES (?)");
    $stmt->execute([$nomcategorie]);
    echo "Categorie " . $nomcategorie . " Ajouter !!!";

    if ($stmt) {
        header("location:../page/categorie.php");
    }
}
