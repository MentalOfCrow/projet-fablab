<?php
require '../../vendor/autoload.php'; // Chemin mis à jour

use setasign\Fpdf\Fpdf;
use setasign\Fpdi\Fpdi;

include '../db/config.php';

// Création du PDF
$pdf = new \FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, "Statistiques des Commandes", 1, 1, 'C');
$pdf->Ln(10);

// Récupération des statistiques
$total_cmd = $pdo->query("SELECT COUNT(*) AS total FROM commandes")->fetch()['total'];
$cmd_attente = $pdo->query("SELECT COUNT(*) AS total FROM commandes WHERE statut = 'en attente'")->fetch()['total'];
$cmd_cours = $pdo->query("SELECT COUNT(*) AS total FROM commandes WHERE statut = 'en cours'")->fetch()['total'];
$cmd_termine = $pdo->query("SELECT COUNT(*) AS total FROM commandes WHERE statut = 'terminé'")->fetch()['total'];

// Affichage des statistiques
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, "Total des commandes : $total_cmd", 0, 1);
$pdf->Cell(190, 10, "En attente : $cmd_attente", 0, 1);
$pdf->Cell(190, 10, "En cours : $cmd_cours", 0, 1);
$pdf->Cell(190, 10, "Terminees : $cmd_termine", 0, 1);
$pdf->Ln(10);

// Générer un graphique en image (avec matplotlib en Python par exemple)
$imagePath = "../public/images/stats_chart.png"; // Image statique ou générée
if (file_exists($imagePath)) {
    $pdf->Image($imagePath, 50, 80, 100);
}

// Téléchargement du fichier PDF
$pdf->Output('D', 'Statistiques_Commandes.pdf');
?>
