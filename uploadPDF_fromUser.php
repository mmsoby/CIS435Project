<?php
require_once('alt_autoload.php-dist');
include('course_reqs.php');
include('generatePDF.php');

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

    //Delete everything after the string "Courses in Progress"
    $text = substr($text, 0, strpos($text, "course(s) in progressterm"));

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

    //Now that the sections are updated and contain the classes that can be taken...
    //print all the sections and their requirements
    foreach ($sections as $section) {
        // Iterate through the requirements
        $section->printCurrentState();
    }


    // We now have a list of courses
    $final_courses = array(
        array(//First semester
            new Course('cis285', 3, array()),
            new Course('cis316', 3, array()),
            new Course('cis376', 4, array()),
            new Course('cis381', 3, array()),
            new Course('cis387', 4, array()),
            new Course('cis400', 4, array())
        ),
        array(//Second semester
            new Course('cis474', 3, array()),
            new Course('cis476', 3, array()),
            new Course('cis479', 3, array()),
            new Course('cis481', 3, array()),
            new Course('cis487', 3, array()),
            new Course('cis488', 3, array()),
            new Course('ccm404', 3, array())
        ),
        array(//Third semester
            new Course('ccm472', 3, array()),
            new Course('ccm473', 3, array()),
            new Course('engr399', 1, array()),
            new Course('engr400', 3, array()),
            new Course('engr492', 1, array()),
            new Course('engr493', 1, array()),
            new Course('ent400', 3, array())
        ),
    );

    // Generate the PDF
    generatePDF($final_courses);
}

//header("Location: GetClasses.html");
?>