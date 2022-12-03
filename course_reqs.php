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
//        // Iterate over the $requirements array
//        foreach ($this->requirements as $key1 => $row) {
//            // Iterate over the $row array
//            foreach ($row as $key2 => $courseSet) {
//                // Iterate over the $courseSet array
//                foreach ($courseSet as $key3 => $course) {
//                    // Check if the name of the $course object appears in the $text variable
//                    if (strpos($text, $course->name) !== false) {
//                        // unset the $course object from the $courseSet array
//                        $this->credits -= $course->credits;
//                        // Echo then unset
//                        echo "Deleting: " . $course->name . " " . $course->credits . " " . $course->prerequisites;
//                        unset($this->requirements[$key1][$key2][$key3]);
//                    } else {
//                        echo "Not deleting: " . $course->name . " " . $course->credits . " " . $course->prerequisites;
//                    }
//                }
//                // Check if the $courseSet array is empty
//                if (empty($courseSet)) {
//                    // unset the $courseSet array from the $row array
//                    unset($this->requirements[$key1][$key2]);
//                }
//            }
//            // Check if the $row array is empty
//            if (empty($row)) {
//                // delete the entire $requirements array
//                unset($this->requirements[$key1]);
//                $this->credits = 0;
//                return;
//            }
//        }


        // Iterate over the $requirements array
        foreach ($this->requirements as $key1 => $row) {
            // Iterate over the $requirement array
            foreach ($row as $key2 => $column) {
                // Iterate over the $row array
                foreach ($column as $key3 => $thirdDimension) {
                    // Iterate over the $courseSet array
                    foreach ($thirdDimension as $key4 => $course) {
                        // Check if the name of the $course object appears in the $text variable
                        if (strpos($text, $course->name) !== false) {
                            // unset the $course object from the $courseSet array
                            $this->credits -= $course->credits;
                            // Echo then mark the column for deletion
                            echo "Deleting: " . $course->name . " " . $course->credits . " " . $course->prerequisites;
                            $this->requirements[$key1][$key2][$key3][$key4] = null;
                        }
                    }
                    // Check if the $thirdDimension array contains null
                    if (in_array(null, $thirdDimension)) {
                        //Delete the column
                        unset($this->requirements[$key1][$key2]);
                    }
                }
            }
            // Check if the $row array is empty
            if (empty($row)) {
                // delete the entire $requirements array
                unset($this->requirements);
                $this->credits = 0;
                return;
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
        //row - One row must get deleted to complete the section
        array(
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //course
                    new Course('comp105', 3, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    new Course('comp270', 3, array())
                )
            )
        ),
    )
);

// Make a section with the requirements as an array of courses for natural science
$ns = new Section(8,
    array(
        //row - One row must get deleted to complete the section
        array(
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses
                    new Course('biol130', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses
                    new Course('biol140', 4, array())
                )
            )
        ),
        //row - One row must get deleted to complete the section
        array(
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('chem144', 4, array()), new Course('chem134', 4, array())
                )
            ),
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('chem136', 4, array())
                )
            )
        ),
        //row - One row must get deleted to complete the section
        array(
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('phys125', 4, array())
                )
            ),
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('phys126', 4, array())
                )
            )
        ),
        //row - One row must get deleted to complete the section
        array(
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('geol118', 4, array())
                )
            ),
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('geol218', 4, array())
                )
            )
        ),
        //row - One row must get deleted to complete the section
        array(
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('phys150', 4, array())
                )
            ),
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('phys151', 4, array())
                )
            )
        ),
    )
);

// Make a section with the requirements as an array of courses for math and stats
$ms = new Section(18,
    array(
        //row - One row must get deleted to complete the section
        array(
            //column - can take any of these options
            array(
                //thirdDimension - must take all in this dimension
                array(
                    //courses - can take just one
                    new Course('math115', 4, array())
                ),
                array(
                    //courses - can take just one
                    new Course('math116', 4, array())
                ),
                array(
                    //courses - can take just one
                    new Course('cis275', 4, array())
                ),
                array(
                    //courses - can take just one
                    new Course('imse317', 4, array())
                ),
                array(
                    //courses - can take just one
                    new Course('math227', 4, array())
                )
            ),
        ),
    )
);


// Global variable to hold the list of sections
$sections = array($wc, $ns);


