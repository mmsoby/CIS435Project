<?php
use setasign\Fpdi\Fpdi;

require_once('src/autoload.php');
require_once('fpdf185/fpdf.php');
require_once('alt_autoload.php-dist');


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

    echo $text;

    // Get all classes from classes.php
    // Define the path to the CSV file
    $file_path = 'classes.csv';

    // Use the file() function to read the CSV file
    $csv = file($file_path);

    // Print the contents of the CSV file
    foreach ($csv as $line) {
        echo $line . "\n";
    }
    // I think over here is where we can start to do the bulk of the logic, involving figuring out what classes have
    // been taken and what classes are left to take. I'm not sure how to do this yet, but I think it's possible.
}

//header("Location: GetClasses.html");
?>