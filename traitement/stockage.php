<?php
session_start();
//var_dump($_SESSION);
require("../BD/connexion.php");

if (!isset($_SESSION['username'])) {
    header("location:../page/index.html");
}
if (isset($_POST['btnstock'])) {
    $categorie = htmlspecialchars($_POST['nomcategorie']);
    $nomproduit = htmlspecialchars($_POST['nomproduit']);
    $quantite = intval($_POST['quantite']);
    $username = $_SESSION['username'];
    $date_val = date("Y-m-d H:i:s");

    $sql = "SELECT nomproduit from stock where nomproduit=:nomproduit";
    $stmt1 = $pdo->prepare($sql);
    $stmt1->bindParam('nomproduit', $nomproduit);
    $stmt1->execute();
    $produitexiste = $stmt1->fetchColumn();

    if (!$produitexiste) {
        try {
            $sql1 = "INSERT INTO `stock`(`nomcategorie`, `nomproduit`, `quantite`, `username`, `date`) VALUES (:categorie,:nomproduit,:quantite,:username,:date_val)";
            $stmt = $pdo->prepare($sql1);
            $stmt->bindParam(':categorie', $categorie);
            $stmt->bindParam(':nomproduit', $nomproduit);
            $stmt->bindParam(':quantite', $quantite);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':date_val', $date_val);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Échec de la connexion : " . $e->getMessage();
        }
    } else {
        $sql2 = "UPDATE `stock` SET `quantite`= quantite + :quantite ,username=:username WHERE nomproduit=:nomproduit";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':nomproduit', $nomproduit);
        $stmt2->bindParam(':quantite', $quantite);
        $stmt2->bindParam(':username', $username);
        $stmt2->execute();
    }
}
