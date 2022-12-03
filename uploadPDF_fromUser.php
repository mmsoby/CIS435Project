<?php
require_once('src/autoload.php');
require_once('fpdf185/fpdf.php');
require_once('alt_autoload.php-dist');
include('course_reqs.php');

if (isset($_FILES['pdfFile'])) {
    $source_file = $_FILES['pdfFile']['tmp_name'];

    // Begin php parse using php library
    $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($source_file);
    $text = $pdf->getText();

    // Remove whitespace from the start and end of the string
    $text = trim($text);

    // Convert the string to lowercase
    $text = strtolower($text);

    global $sections;

    // Iterate through the sections
    foreach ($sections as $section) {
        // Iterate through the requirements
        $section->iTookTheseCourses($text);
        
        if ($section->isComplete()) {
            echo "Section complete";
        } else {
            echo "Section incomplete";
        }

    }

}

//header("Location: GetClasses.html");
?>