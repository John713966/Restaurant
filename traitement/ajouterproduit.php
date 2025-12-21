<?php
require("../BD/connexion.php");

$stmt = $pdo->query("select nomcategorie from categorie");
?>
</select>
</div>
<?php

if (isset($_POST['btnproduit'])) {
    $nomproduit = htmlspecialchars($_POST['nomproduit']);
    $prixproduit = intval($_POST['prixproduit']);
    $nomcategorie = htmlspecialchars($_POST['nomcategorie']);
    $stmt = $pdo->prepare("INSERT INTO `produits`(`nomproduit`, `nomcategorie`, `prixproduit`) VALUES (?,?,?)");
    $stmt->execute([$nomproduit, $nomcategorie, $prixproduit]);
    echo "Produit " . $nomproduit . " Ajouter !!!";

    if ($stmt) {
        header("location:../page/platboisson.php");
    }
}

