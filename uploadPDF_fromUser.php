<?php
if ( isset( $_FILES['pdfFile'] ) ) {
	if ($_FILES['pdfFile']['type'] == "application/pdf") {
		$source_file = $_FILES['pdfFile']['tmp_name'];
		$new_str = str_replace(" ", "", $_FILES['pdfFile']['name']);
		$new_str = str_replace("%20", "", $new_str);
		$dest_file = "Resources/UserFiles/".$new_str;

		echo '<head><script type="text/javascript" src="js/GenerateClasses.js"></script></head>';

        // Call the generateClasses javascript function
        echo '<script type="text/javascript">window.onload = function() {GenerateClass('.'"Resources/UserFiles/'.$new_str.'");};</script>';

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