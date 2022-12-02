<?php
use setasign\Fpdi\Fpdi;

require_once('src/autoload.php');
require_once('fpdf185/fpdf.php');


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
//         $parser = new \Smalot\PdfParser\Parser();
//         $pdf    = $parser->parseFile($source_file);
//         $text = $pdf->getText();
//         echo $text;
// Create a new instance of the FPDI class
$pdf = new FPDI();

// Add a page to the PDF document
$pdf->AddPage();

// Set the source PDF file
$pdf->setSourceFile($source_file);

// Determine the number of pages in the PDF file
$pageCount = $pdf->setSourceFile($source_file);

// Initialize the $text variable to an empty string
$text = '';

// Loop through all of the pages in the PDF file
for ($i = 1; $i <= $pageCount; $i++) {
    // Import the current page of the PDF file
    $page = $pdf->importPage($i);

    // Determine the dimensions of the imported page
    $size = $pdf->getTemplateSize($page);

    // Set the dimensions of the imported page using the values from the $size variable
    $pdf->useTemplate($page, 0, 0, $size['width'], $size['height']);

    // Extract the text from the current page of the PDF file
    $pageText = $pdf->getPageText($i);

    // Concatenate the text from the current page to the $text variable
    $text .= $pageText;
}


// Extract the text from the PDF file using the FPDI library
$text = $pdf->getPageText(1);


// Use regular expressions or other string manipulation functions in PHP
// to extract the specific data you need from the PDF file
echo $text;

// Clean up
unset($pdf);


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