<?php
use setasign\Fpdi\Fpdi;

require_once('src/autoload.php');
require_once('fpdf185/fpdf.php');
require_once('alt_autoload.php-dist');
require_once('course_reqs.php');

if ( isset( $_FILES['pdfFile'] ) ) {
    $source_file = $_FILES['pdfFile']['tmp_name'];

    // Begin php parse using php library
    $parser = new \Smalot\PdfParser\Parser();
    $pdf    = $parser->parseFile($source_file);
    $text = $pdf->getText();

    // Remove whitespace from the start and end of the string
    $text = trim($text);

    // Convert the string to lowercase
    $text = strtolower($text);

    //text now contains the text of the pdf
    foreach($sections as $section){
        echo $section;
    }







}

//header("Location: GetClasses.html");
?>