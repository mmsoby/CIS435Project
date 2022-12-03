<?php
require_once('alt_autoload.php-dist');
include('course_reqs.php');
include('generatePDF.php');

function makeSemestersOutOfCourses($courses): array
{
    $semesters = array();
    $semester = new Semester();
    $semester->addCourse($courses[0]);
    $semesters[] = $semester;
    for ($i = 1; $i < count($courses); $i++) {
        $course = $courses[$i];
        $semester = $semesters[count($semesters) - 1];
        if ($semester->canAddCourse($course)) {
            $semester->addCourse($course);
        } else {
            $semester = new Semester();
            $semester->addCourse($course);
            $semesters[] = $semester;
        }
    }
    return $semesters;
}

if (isset($_FILES['pdfFile'])) {
    error_reporting(E_ERROR | E_PARSE);
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
    ob_start();

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
    ob_end_clean();
    ob_start();

    //Now that the sections are updated and contain the classes that can be taken...
    //print all the sections and their requirements
    $final_courses = array();
    foreach ($sections as $section) {
        // Iterate through the requirements
        $final_courses = array_merge($final_courses, $section->getRemainingCourses());
    }


    // We now have a list of semesters
    $semesters = makeSemestersOutOfCourses($final_courses);

    //Print the semesters
//    foreach ($semesters as $semester) {
//        echo $semester;
//        echo "<br>";
//    }

    $output = ob_get_clean();
    echo $output;


    //Generate the PDF
    //generatePDF($semesters);
}

//header("Location: GetClasses.html");
?>