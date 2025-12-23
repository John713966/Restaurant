<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../BD/connexion.php");


//Supprimer Une categorie
$id = $_GET['id'];
$sql = "DELETE FROM `categorie` WHERE idcategorie=$id";
$stmt = $pdo->query($sql);
header("location:../page/categorie.php? Suppression reusite!!!");


//Supprimer Un Produit dans la liste
$id = $_GET['id'];
$sql = "DELETE FROM `produit` WHERE idproduit=$id";
$stmt = $pdo->query($res);
header("location:../page/listeproduit.php? Suppression reusite!!!");
