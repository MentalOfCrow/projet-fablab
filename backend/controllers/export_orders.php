<?php
require '../../vendor/autoload.php'; // Pour utiliser PhpSpreadsheet

use setasign\Fpdf\Fpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include '../db/config.php';

// Récupérer les dates du formulaire
$start_date = $_POST['start_date'] ?? null;
$end_date = $_POST['end_date'] ?? null;

// Créer l'export PDF ou Excel en fonction du format sélectionné
if (isset($_POST['export_orders'])) {

    // Export PDF
    if ($_POST['export_format'] == 'pdf') {
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, "Historique des Commandes", 1, 1, 'C');
        $pdf->Ln(10);

        // En-têtes du tableau
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Commande', 1);
        $pdf->Cell(40, 10, 'Client', 1);
        $pdf->Cell(30, 10, 'Couleur', 1);
        $pdf->Cell(40, 10, 'Statut', 1);
        $pdf->Cell(40, 10, 'Date', 1);
        $pdf->Ln();

        // Filtrage des commandes par date si nécessaire
        $sql = "SELECT commandes.*, users.fullname 
                FROM commandes 
                JOIN users ON commandes.utilisateur_id = users.id";
        
        if ($start_date && $end_date) {
            $sql .= " WHERE commandes.date_creation BETWEEN :start_date AND :end_date";
        }

        $stmt = $pdo->prepare($sql);

        if ($start_date && $end_date) {
            $stmt->execute(['start_date' => $start_date, 'end_date' => $end_date]);
        } else {
            $stmt->execute();
        }

        // Récupérer et afficher les commandes
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
    }

    // Export Excel
    elseif ($_POST['export_format'] == 'excel') {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Commande')
              ->setCellValue('B1', 'Client')
              ->setCellValue('C1', 'Couleur')
              ->setCellValue('D1', 'Statut')
              ->setCellValue('E1', 'Date');

        $row = 2;

        // Filtrage des commandes par date
        $sql = "SELECT commandes.*, users.fullname 
                FROM commandes 
                JOIN users ON commandes.utilisateur_id = users.id";
        
        if ($start_date && $end_date) {
            $sql .= " WHERE commandes.date_creation BETWEEN :start_date AND :end_date";
        }

        $stmt = $pdo->prepare($sql);

        if ($start_date && $end_date) {
            $stmt->execute(['start_date' => $start_date, 'end_date' => $end_date]);
        } else {
            $stmt->execute();
        }

        // Remplir les données dans le fichier Excel
        while ($data = $stmt->fetch()) {
            $sheet->setCellValue('A' . $row, $data['nom_commande']);
            $sheet->setCellValue('B' . $row, $data['fullname']);
            $sheet->setCellValue('C' . $row, $data['couleur']);
            $sheet->setCellValue('D' . $row, $data['statut']);
            $sheet->setCellValue('E' . $row, date("d/m/Y", strtotime($data['date_creation'])));
            $row++;
        }

        // Écrire le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'Historique_Commandes.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        $writer->save('php://output');
    }
}
?>
