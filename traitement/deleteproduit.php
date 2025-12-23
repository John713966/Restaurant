<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../BD/connexion.php");


//Supprimer Un Produit dans la liste
$id = $_GET['id'];
$sql = "DELETE FROM `produits` WHERE idproduit=$id";
$stmt = $pdo->query($sql);
header("location:../page/listeproduit.php? Suppression reusite!!!");
