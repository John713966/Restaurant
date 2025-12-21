<?php
session_start();

// Démarre la session
require("../BD/connexion.php"); // Inclut la connexion à la base de données

// Correction: Utiliser isset($_POST['btnconnect']) pour vérifier si le formulaire a été soumis
if (isset($_POST['btnconnect'])) {
    $username = $_POST['username'];
    $password = $_POST['passwd'];

    try {
        // CORRECTION MAJEURE : On sélectionne 'id', 'username' et 'password'
        // 'id' est nécessaire pour le stocker dans la session.
        $stmt = $pdo->prepare("SELECT iduser, username, passwd FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['passwd'])) {
            // L'utilisateur est authentifié avec succès
            $_SESSION['user_id'] = $user['iduser'];
            $_SESSION['username'] = $user['username'];

            // Redirection vers la page d'accueil sécurisée
            header("Location:../page/accueil.php");
            exit(); // EXCELLENTE PRATIQUE : Arrête le script après la redirection
        } else {
            // Identifiants invalides
            echo "Nom d'utilisateur ou mot de passe invalide.";
        }
    } catch (PDOException $e) {
        echo "Échec de la connexion : " . $e->getMessage();
    }
}
