<?php
require_once('alt_autoload.php-dist');
include('course_reqs.php');
include('generatePDF.php');

function makeSemestersOutOfCourses($courses, $maxCredits): array
{
    $semesters = array();
    $semester = new Semester();
    $semester->addCourse($courses[0]);
    $semesters[] = $semester;

    //Sort courses by the number of prerequisites they have
//    usort($courses, function ($a, $b) {
//        return count($a->prerequisites) - count($b->prerequisites);
//    });

    for ($i = 1; $i < count($courses); $i++) {
        $course = $courses[$i];
        $semester = $semesters[count($semesters) - 1];
        //if the course name is cis4951 or cis4952, skip it
        if ($course->name == "cis4951" || $course->name == "cis4952") {
            continue;
        }
        if ($semester->canAddCourse($course, $maxCredits)) {
            $semester->addCourse($course);
        } else {
            $semester = new Semester();
            $semester->addCourse($course);
            $semesters[] = $semester;
        }
    }

    //if one of the $courses has a course named cis4952, add it to the last semester
    foreach ($courses as $course) {
        if ($course->name == "cis4952") {
            $semesters[count($semesters) - 1]->addCourse($course);
        }
    }

    //If there are more than two semesters
    foreach ($courses as $course) {
        if ($course->name == "cis4951") {
            if (count($semesters) > 2) {
                $semesters[count($semesters) - 2]->addCourse($course);
            } else {
                $semester = new Semester();
                $semester->addCourse($course);
                //Add the new semester to the beginning of the array
                array_unshift($semesters, $semester);
            }
        }
    }


    return $semesters;
}

if (isset($_FILES['pdfFile'])) {
    error_reporting(E_ERROR | E_PARSE);
    $source_file = $_FILES['pdfFile']['tmp_name'];

    //Upload the file to the server


    // Begin php parse using php library
    $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($source_file);
    $text = $pdf->getText();

    // Remove whitespace from the start and end of the string
    $text = trim($text);

    // Convert the string to lowercase
    $text = strtolower($text);

    //Delete everything after the string "Courses in Progress"
    $pos = strrpos($text, "term");
    if ($pos !== false) {
        $pos = strrpos(substr($text, 0, $pos), "term");
    }

// If "term" was found, delete everything after it
    if ($pos !== false) {
        $text = substr($text, 0, $pos + strlen("term"));
    }
//    echo $text;

    global $sections;
    ob_start();

    // Iterate through the sections
    foreach ($sections as $section) {
        // Iterate through the requirements
        $text = $section->iTookTheseCourses($text);

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
    $semesters = makeSemestersOutOfCourses($final_courses, $_POST['maxCredits']);

    //Print the semesters
    foreach ($semesters as $semester) {
        echo $semester;
        echo "<br>";
    }

    $output = ob_get_clean();
    echo $output;


    //Generate the PDF
    generatePDF($semesters);
}

//header("Location: GetClasses.html");
?>