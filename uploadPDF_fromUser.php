<?php
require_once('alt_autoload.php-dist');
include('course_reqs.php');
include('generatePDF.php');
// import the composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// import the namespaces
use Symfony\Component\Filesystem\Filesystem,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverterCommand,
    Xthiago\PDFVersionConverter\Converter\GhostscriptConverter;


function makeSemestersOutOfCourses($courses, $maxCredits): array
{
    $semesters = array();
    //Get the total number of credtis
    $totalCredits = 0;
    for ($i = 0; $i < count($courses); $i++) {
        $totalCredits += $courses[$i]->credits;
    }
    echo "Total Credits: " . $totalCredits . "<br>";

    //Get the number of semesters
    $numSemesters = ceil($totalCredits / $maxCredits);
    echo "numSemesters: " . $numSemesters . "<br>";

    //Create the $numSemesters number of semesters
    for ($i = 0; $i < $numSemesters; $i++) {
        $semesters[] = new Semester();
    }

    //If $courses contains cis4951, add it to the second to last semester and remove it from $courses
    for ($i = 0; $i < count($courses); $i++) {
        if ($courses[$i]->name == "cis4952") {
            $semesters[$numSemesters - 1]->addCourse($courses[$i]);
        }

        // Do the same for cis4951
        if ($courses[$i]->name == "cis4951") {
            $semesters[$numSemesters - 2]->addCourse($courses[$i]);
        }
    }

    //Add the remaining courses to the semesters
    $lookingAtSemester = 0;
    for ($i = 0; $i < count($courses); $i++) {
        $course = $courses[$i];
        //if the course name is cis4951 or cis4952, skip it
        if ($course->name == "cis4951" || $course->name == "cis4952") {
            continue;
        }
        if (!$semesters[$lookingAtSemester]->canAddCourse($course, $maxCredits)) {
            $lookingAtSemester += 1;
        }
        echo "lookingAtSemester: " . $lookingAtSemester . "<br>";
        echo "course: " . $course->name . "<br>";
        //If $semesters[$lookingAtSemester] is null, create a new semester
        if ($semesters[$lookingAtSemester] == null) {
            $semesters[$lookingAtSemester] = new Semester();
        }
        $semesters[$lookingAtSemester]->addCourse($course);
    }

    return $semesters;
}

function getPDFText($file_destination)
{
    $command = new GhostscriptConverterCommand();
    $filesystem = new Filesystem();

    $converter = new GhostscriptConverter($command, $filesystem);
    $converter->convert($file_destination, '1.3');
    // Begin php parse using php library
    $parser = new \Smalot\PdfParser\Parser();
    try {
        $pdf = $parser->parseFile($file_destination);
    } catch (Exception $e) {
        //echo "Error: " . $e->getMessage();
        exit;
    }
    return $pdf->getText();
}

if (isset($_FILES['pdfFile'])) {
    ob_start();
    error_reporting(E_ERROR | E_PARSE);
    $source_file = $_FILES['pdfFile']['tmp_name'];

    $new_file_name = $_FILES['pdfFile']['name'];

    echo $source_file;
    echo $new_file_name;

    //Upload the file to the server
    $file_destination = 'Resources/UserFiles/' . $new_file_name;
    //try file upload
    if (move_uploaded_file($source_file, $file_destination)) {
        echo "File uploaded successfully";
    } else {
        echo "File upload failed";
    }

    $text = getPDFText($file_destination);

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
    echo $text;

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
    //if $_POST['maxCredits'] is not set, set it to 18
    $maxCredits = 18;
    if (isset($_POST['maxCredits'])) {
        $maxCredits = $_POST['maxCredits'];
    }

    $semesters = makeSemestersOutOfCourses($final_courses, $maxCredits);

    //Print the semesters
    foreach ($semesters as $semester) {
        echo $semester;
        echo "<br>";
    }

    $output = ob_get_clean();
    echo $output;

    ob_end_clean();
    //Generate the PDF
    generatePDF($semesters);
}

//header("Location: GetClasses.html");
?>