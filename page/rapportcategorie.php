<?php
session_start();
require('fpdf.php');
require("../BD/connexion.php");
if (isset($_POST['btnrapport'])) {
    $datedebut = $_POST['datedebut1'] . " 00:00:00";
    $datefin = $_POST['datefin1'] . " 23:59:59";
    $categorie = htmlspecialchars($_POST['cateogie']);

    class PDF extends FPDF
    {
        // En-tête
        function Header()
        {
            // Logo
            $this->Image('logo.png', 10, 6, 30);
            // Police Arial gras 15
            $this->SetFont('times', 'B', 15);
            // Décalage à droite
            $this->Cell(65);
            // Titre
            $this->Cell(60, 10, 'Rue Panamericaine #28,Petion-Ville', 0, 0, 'C');
            $this->Ln(7);
            $this->Cell(65);
            $this->Cell(60, 10, 'Rapport de Ventes', 0, 0, 'C');
            // Saut de ligne
            $this->Ln(30);
        }

        // Pied de page
        function Footer()
        {
            // Positionnement à 1,5 cm du bas
            $this->SetY(-20);
            $this->SetFont('Arial', 'I', 8);
            // Numéro de page
            $this->Cell(0, 10, '_______________________________ Responsable', 0, 0, 'L');
            $this->Cell(0, 10, '_______________________________ utlilisateur ', 0, 1, 'R');
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    // Instanciation de la classe dérivée
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    //entete
    $pdf->Cell(10);
    $pdf->Cell(40, 10, 'Nom produit', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Quantite Vendue', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Prix Unite', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Prix total', 1, 1, 'C');
    // requete
    //var_dump($datedebut, $datefin, $username);
    $sql = "SELECT `idcommande`, `nomproduit`, `quantite`, `prix`, `total` FROM `commande` WHERE categorie=:categorie AND `date` BETWEEN :datedebut AND :datefin GROUP BY nomproduit";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam('datedebut', $datedebut);
    $stmt->bindParam('datefin', $datefin);
    $stmt->bindParam('categorie', $categorie);
    $stmt->execute();
    //$sql = "SELECT `nomproduit`, SUM(quantite) AS quantite, prix, SUM(total) AS total FROM `commande` GROUP BY nomproduit";
    //$stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        $pdf->Cell(40, 10, 'Aucune donnees', 2, 0, 'C');
    } else {
        try {
            do {
                $pdf->SetFont('times', '', 12);
                $pdf->Cell(10);
                $pdf->Cell(40, 10, $row['nomproduit'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['quantite'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['prix'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['total'], 1, 1, 'C');
            } while ($row = $stmt->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            die("Erreur" . $e->getMessage());
        }
    }
    $pdf->Output('rapport', 'I');
}
