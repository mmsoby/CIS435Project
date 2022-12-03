<?php
require_once('src/autoload.php');
require_once('fpdf185/fpdf.php');

function generatePDF($semesters)
{
    $output = ob_get_clean();

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Hello World!');
    $pdf->Output();
    echo $output;
}