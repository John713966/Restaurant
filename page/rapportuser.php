<?php
session_start();
require('fpdf.php');
require("../BD/connexion.php");
if (isset($_POST['btnrapport'])) {
    $datedebut = $_POST['datedebut'] . " 00:00:00";
    $datefin = $_POST['datefin'] . " 23:59:59";
    $username = htmlspecialchars($_POST['username']);

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
            $this->Cell(60, 10, 'Phone :(+509 34246697 / 41296527 )', 0, 0, 'C');
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

    //$sql = "SELECT `nomproduit`, SUM(quantite) AS quantite, prix, SUM(total) AS total FROM `commande` GROUP BY nomproduit";
    //$stmt = $pdo->query($sql);
    if (!$username) {
        $sql = "SELECT `nomproduit`, SUM(quantite) as quantite, `prix`, SUM(total) as total FROM `commande` WHERE `date` BETWEEN :datedebut AND :datefin GROUP BY nomproduit";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('datedebut', $datedebut);
        $stmt->bindParam('datefin', $datefin);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            foreach ($results as $row) {
                $pdf->SetFont('times', '', 12);
                $pdf->Cell(10);
                $pdf->Cell(40, 10, $row['nomproduit'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['quantite'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['prix'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['total'], 1, 1, 'C');
            }
        } else {
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(10);
            $pdf->Cell(170, 10, 'Aucune donnée trouvée pour cette période', 1, 1, 'C');
        }
    } else {
        $sql = "SELECT `nomproduit`, SUM(quantite) as quantite, `prix`, SUM(total) as total FROM `commande` WHERE user=:username AND `date` BETWEEN :datedebut AND :datefin GROUP BY nomproduit";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('datedebut', $datedebut);
        $stmt->bindParam('datefin', $datefin);
        $stmt->bindParam('username', $username);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            foreach ($results as $row) {
                $pdf->SetFont('times', '', 12);
                $pdf->Cell(10);
                $pdf->Cell(40, 10, $row['nomproduit'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['quantite'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['prix'], 1, 0, 'C');
                $pdf->Cell(40, 10, $row['total'], 1, 1, 'C');
            }
        } else {
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(10);
            $pdf->Cell(170, 10, 'Aucune donnée trouvée pour cet utilisateur et cette période', 1, 1, 'C');
        }
    }
    $pdf->SetY(11);
    $pdf->SetFont('Arial', 'I', 8);
    // Numéro de page
    $pdf->Cell(0, 10, 'USER : ' . $username, 0, 0, 'R');
    $pdf->Output('rapport', 'I');
}
