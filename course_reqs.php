<?php

// Class to represent a course
class Course
{
    public $name;
    public $credits;
    public $prerequisites;

    public function __construct($name, $credits, $prerequisites)
    {
        $this->name = $name;
        $this->credits = $credits;
        $this->prerequisites = $prerequisites;
    }
}

class Section
{
    public $credits;
    public $requirements;

    public function __construct($credits, $requirements)
    {
        $this->credits = $credits;
        $this->requirements = $requirements;
    }

    public function iTookTheseCourses($text)
    {
        foreach ($this->requirements as $requirement) {
            foreach ($requirement as $row) {
                foreach ($row as $courseSet) {
                    foreach ($courseSet as $course) {
                        if (strpos($text, $course->name) !== false) {
                            // Course found, now remove it from the requirements
                            $courseSet->remove($course);
                        }
                        if ($courseSet->isEmpty()) {
                            // Course set is empty, remove it from the row
                            $row->remove($courseSet);
                        }
                        if ($row->isEmpty()) {
                            // Row is empty, delete the requirement variable
                            unset($requirement);
                        }
                    }
                }
            }
        }
    }

    public function isComplete(): bool
    {
        return $this->credits == 0;
    }
}

// Make a section with the requirements as an array of courses
//wc is Written Communication
$wc = new Section(6,
    array(
        array(array(new Course('comp105', 3, array())), array(new Course('comp270', 3, array())))
    )
);

// Make a section with the requirements as an array of courses for natural science
$ns = new Section(8,
    array(
        array(array(new Course('biol130', 4, array())), array(new Course('biol140', 4, array()))),
        array(array(new Course('chem144', 4, array()), new Course('chem134', 4, array())), array(new Course('chem136', 4, array()))),
        array(array(new Course('geol118', 4, array())), array(new Course('geol218', 4, array()))),
        array(array(new Course('phys125', 4, array())), array(new Course('phys126', 4, array()))),
        array(array(new Course('phys150', 4, array())), array(new Course('phys151', 4, array()))),
    )
);

// Global variable to hold the list of sections
$sections = array($wc, $ns);


