<?php
use setasign\Fpdi\Fpdi;

require_once('src/autoload.php');
require_once('fpdf185/fpdf.php');
require_once('alt_autoload.php-dist');


if ( isset( $_FILES['pdfFile'] ) ) {
	if ($_FILES['pdfFile']['type'] == "application/pdf") {
		$source_file = $_FILES['pdfFile']['tmp_name'];
		$new_str = str_replace(" ", "", $_FILES['pdfFile']['name']);
		$new_str = str_replace("%20", "", $new_str);
		$dest_file = "Resources/UserFiles/".$new_str;

// 		echo '<head><script type="module" src="GenerateClasses.js"></script></head>';
//
//         // Call the generateClasses javascript function
//         echo '<script type="text/javascript">window.onload = function() {GenerateClass('.'"../Resources/UserFiles/'.$new_str.'");};</script>';

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



// Use regular expressions or other string manipulation functions in PHP
// to extract the specific data you need from the PDF file
// echo $text;
//
// // Clean up
// unset($pdf);


		if (file_exists($dest_file)) {
			print "The file name already exists!!";
		}
		else {
			move_uploaded_file( $source_file, $dest_file )
			or die ("Error!!");
			if($_FILES['pdfFile']['error'] == 0) {
				print "Pdf file uploaded successfully!";
				print "<b><u>Details : </u></b><br/>";
				print "File Name : ".$_FILES['pdfFile']['name']."<br.>"."<br/>";
				print "File Size : ".$_FILES['pdfFile']['size']." bytes"."<br/>";
				print "File location : Resources/UserFiles/".$new_str."<br/>";
			}
		}
	}
	else {
		if ( $_FILES['pdfFile']['type'] != "application/pdf") {
			print "Error occured while uploading file : ".$_FILES['pdfFile']['name']."<br/>";
			print "Invalid  file extension, should be pdf !!"."<br/>";
			print "Error Code : ".$_FILES['pdfFile']['error']."<br/>";
		}
	}
}

//header("Location: GetClasses.html");
?>