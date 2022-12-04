<?php
require_once('src/autoload.php');
require_once('fpdf185/fpdf.php');

function getStartingDate($semNum): string
{
    // Get the current date and time
    $currentDate = new DateTime();

    // Get the current year
    $currentYear = intval($currentDate->format('Y')) + $semNum;

    // Get the current month (as a number from 1 to 12)
    $currentMonth = $currentDate->format('n');

    // Check if the current date is between January and August
    if ($currentMonth >= 1 && $currentMonth <= 8) {
        // If it is, return "Fall <year>"
        return "Fall " . $currentYear;
    } else {
        // Otherwise, return "Winter <year+1>"
        return "Winter " . (intval($currentYear) + 1);
    }
}


function generatePDF($semesters)
{
    $output = ob_get_clean();

    //Generate the PDF
    $pdf = new FPDF();

    // set the document title and add a page to the document
    $pdf->SetTitle('My Degree Plan');
    $pdf->AddPage();

    // set the font and font size for the document
    $pdf->SetFont('Arial', 'B', 16);

    // iterate over the semesters array and add a block for each semester
    for ($i = 0; $i < count($semesters); $i++) {
        // set the fill color for the semester box
        $pdf->SetFillColor(255, 255, 0);

        // add a rectangle for the semester box
        $pdf->Rect(10, $pdf->GetY(), 190, 10, 'DF');

        // add the semester name to the document
        $pdf->Cell(0, 10, getStartingDate($i));

        // add a line break after the semester name
        $pdf->Ln();

        // add the courses for the current semester
        foreach ($semesters[$i]->courses as $course) {
            // add the course name to the document
            $pdf->Cell(0, 10, $course->name);

            // add a line break after the course name
            $pdf->Ln();
        }
    }


    $pdf->Output();
    echo $output;
}