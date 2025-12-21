<?php
require("../BD/connexion.php");
session_start();

// Vérification si le formulaire a été soumis
if (isset($_POST['btncommande'])) {
    // Validation et sécurisation des données d'entrée
    $nomproduit = htmlspecialchars($_POST['nomproduit']);
    $quantite = intval($_POST['quantite']);
    $username = $_SESSION['username'];
    $date_val = date("Y-m-d H:i:s");
    $taxe = 0.00;

    try {
        // Récupération du prix du produit
        $sql4 = "SELECT prixproduit FROM produits WHERE nomproduit=:nomproduit";
        $stmt4 = $pdo->prepare($sql4);
        $stmt4->bindParam(':nomproduit', $nomproduit);
        $stmt4->execute();
        $prixproduit = $stmt4->fetchColumn();

        if (!$prixproduit) {
            throw new Exception("Produit introuvable");
        }

        $total = $prixproduit * $quantite;

        // Vérification de l'existence du produit et de la quantité en stock
        $sql = "SELECT nomproduit, quantite FROM stock WHERE nomproduit=:nomproduit";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nomproduit', $nomproduit);
        $stmt->execute();
        $stock_info = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si le produit existe et s'il y a assez de stock
        if ($stock_info && $stock_info['quantite'] > 0 && $stock_info['quantite'] >= $quantite) {

            // Insertion de la commande
            $sql1 = "INSERT INTO `commande`(`nomproduit`, `quantite`, `prix`, `total`, `taxe`, `user`, `date`) 
                     VALUES (:nomproduit, :quantite, :prix, :total, :taxe, :username, :date)";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->bindParam(':nomproduit', $nomproduit);
            $stmt1->bindParam(':quantite', $quantite);
            $stmt1->bindParam(':prix', $prixproduit);
            $stmt1->bindParam(':total', $total);
            $stmt1->bindParam(':taxe', $taxe);
            $stmt1->bindParam(':username', $username);
            $stmt1->bindParam(':date', $date_val);

            if ($stmt1->execute()) {
                // Mise à jour du stock
                $sql3 = "UPDATE `stock` SET `quantite` = quantite - :quantite, `username` = :username WHERE nomproduit=:nomproduit";
                $stmt3 = $pdo->prepare($sql3);
                $stmt3->bindParam(':nomproduit', $nomproduit);
                $stmt3->bindParam(':quantite', $quantite);
                $stmt3->bindParam(':username', $username);

                if ($stmt3->execute()) {
                    echo "Commande passée avec succès!";
                    header("Location: ../page/commande.php?success=1");
                } else {
                    throw new Exception("Erreur lors de la mise à jour du stock");
                }
            } else {
                throw new Exception("Erreur lors de l'insertion de la commande");
            }
        } else {
            echo "INDISPONIBLE POUR LE MOMENT:<br>";
            echo "1) $nomproduit introuvable <br>";
            echo "2)Stock disponible: " . ($stock_info['quantite'] ?? 0);
        }
    } catch (Exception $e) {
        // Gestion des erreurs
        error_log("Erreur dans passercom.php: " . $e->getMessage());
        echo "Une erreur s'est produite: " . $e->getMessage();
    }
}
