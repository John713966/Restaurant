<?php
//Supprimer Une categorie
include("../BD/connexion.php");
$id = $_GET['idcategorie'];
$sql = "DELETE FROM `categorie` WHERE idcategorie=$id";
$stmt = $pdo->query($res);
header("location:categorie.php? Suppression reusite!!!");


//Supprimer Un Produit dans la liste
$id = $_GET['idproduit'];
$sql = "DELETE FROM `produit` WHERE idproduit=$id";
$stmt = $pdo->query($res);
header("location:listeproduit.php? Suppression reusite!!!");
