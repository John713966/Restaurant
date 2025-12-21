<?php
// get_products.php

// 1. Définir le type de contenu de la réponse comme JSON
header('Content-Type: application/json');

// Vérifier si le nom de la catégorie a été envoyé via POST
if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
    $categoryName = $_POST['category_name'];

    // --- Connexion à la Base de Données ---
    $dsn = 'mysql:host=localhost;dbname=restaurant;charset=utf8';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. Requête SQL pour récupérer les produits par nom de catégorie
        // Assurez-vous que les tables/colonnes correspondent à votre structure de BDD
        $sql = "SELECT nomproduit  FROM produits   WHERE nomcategorie = :category_name";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category_name', $categoryName);
        $stmt->execute();

        // 3. Récupérer tous les produits
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 4. Renvoyer le tableau de produits en tant que JSON
        echo json_encode($products);
    } catch (PDOException $e) {
        // En cas d'erreur de base de données
        http_response_code(500);
        echo json_encode(['error' => 'Erreur de base de données : ' . $e->getMessage()]);
    }
} else {
    // Si la requête est mauvaise (pas de nom de catégorie)
    http_response_code(400);
    echo json_encode(['error' => 'Nom de catégorie non fourni.']);
}

exit;
