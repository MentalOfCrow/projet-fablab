<?php
require '../../vendor/autoload.php'; // Chemin mis à jour

use setasign\Fpdf\Fpdf;
use setasign\Fpdi\Fpdi;


include '../db/config.php';

// Création du PDF
$pdf = new \FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, "Historique des Commandes", 1, 1, 'C');
$pdf->Ln(10);

// En-têtes de tableau
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Commande', 1);
$pdf->Cell(40, 10, 'Client', 1);
$pdf->Cell(30, 10, 'Couleur', 1);
$pdf->Cell(40, 10, 'Statut', 1);
$pdf->Cell(40, 10, 'Date', 1);
$pdf->Ln();

// Récupérer les commandes depuis la base
$stmt = $pdo->query("
    SELECT commandes.*, users.fullname 
    FROM commandes 
    JOIN users ON commandes.utilisateur_id = users.id
    ORDER BY commandes.date_creation DESC
");

$pdf->SetFont('Arial', '', 12);
while ($row = $stmt->fetch()) {
    $pdf->Cell(40, 10, utf8_decode($row['nom_commande']), 1);
    $pdf->Cell(40, 10, utf8_decode($row['fullname']), 1);
    $pdf->Cell(30, 10, utf8_decode($row['couleur']), 1);
    $pdf->Cell(40, 10, utf8_decode($row['statut']), 1);
    $pdf->Cell(40, 10, date("d/m/Y", strtotime($row['date_creation'])), 1);
    $pdf->Ln();
}

// Téléchargement du fichier PDF
$pdf->Output('D', 'Historique_Commandes.pdf');
?>
