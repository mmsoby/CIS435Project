<?php
use setasign\Fpdi\Fpdi;

require_once('src/autoload.php');
require_once('fpdf185/fpdf.php');
require_once('alt_autoload.php-dist');

function remaining_courses( $courses_taken) {
 // Create the dictionary of requirements and courses that fulfill them
  $req_dict = [
    "math" => [
      [new Course("Calculus", 4, ["Pre-Calculus"]), new Course("Linear Algebra", 3, ["Calculus"])],
      [new Course("Statistics", 3, ["Pre-Calculus"]), new Course("Discrete Mathematics", 2, ["Calculus"])]
    ],
    "science" => [
      [new Course("Biology", 4, ["Chemistry"]), new Course("Chemistry", 3, ["Physics"])],
      [new Course("Physics", 4, []), new Course("Astronomy", 2, ["Physics"])]
    ],
    "english" => [
      [new Course("Writing", 3, ["Grammar"]), new Course("Literature", 3, ["Writing"])],
      [new Course("Grammar", 2, []), new Course("Composition", 2, ["Grammar"])]
    ],
  ];

  // List to store the remaining requirements
  $remaining = [];

  // Iterate through the requirements
  foreach ($requirements as $req) {
    // Check if the student has taken any of the courses in any of the groups that fulfill the requirement
    $req_fulfilled = false;
    foreach ($req_dict[$req] as $course_group) {
      $group_fulfilled = true;
      foreach ($course_group as $course) {
        if (!in_array($course->name, $courses_taken)) {
          // Check if the student has taken the prerequisites for this course
          $prereq_fulfilled = true;
          foreach ($course->prerequisites as $prereq) {
            if (!in_array($prereq, $courses_taken)) {
              $prereq_fulfilled = false;
              break;
            }
          }

          if (!$prereq_fulfilled) {
            $group_fulfilled = false;
            break;
          }
        }
      }

      if ($group_fulfilled) {
        $req_fulfilled = true;
        break;
      }
    }

    // If the requirement has not been fulfilled, add it to the list of remaining requirements
    if (!$req_fulfilled) {
      $remaining[] = $req;
    }
  }

  return $remaining;
}


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

// Class to represent a course
class Course {
  public $name;
  public $credits;
  public $prerequisites;

  public function __construct($name, $credits, $prerequisites) {
    $this->name = $name;
    $this->credits = $credits;
    $this->prerequisites = $prerequisites;
  }
}

$remaining_classes = remaining_courses(["Calculus", "Physics", "Grammar", "Composition"]);



}

//header("Location: GetClasses.html");
?>