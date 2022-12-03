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
        // Iterate over the $requirements array
        foreach ($this->requirements as $key1 => $row) {
            // Iterate over the $requirement array
            foreach ($row as $key2 => $column) {
                // Iterate over the $row array
                foreach ($column as $key3 => $thirdDimension) {
                    // Iterate over the $courseSet array
                    $delete_column = false;
                    foreach ($thirdDimension as $key4 => $course) {
                        // Check if the name of the $course object appears in the $text variable
                        if (strpos($text, $course->name) !== false) {
                            // unset the $course object from the $courseSet array
                            $this->credits -= $course->credits;
                            // Echo then mark the column for deletion
                            echo "Deleting: " . $course->name . " " . $course->credits . " " . $course->prerequisites;
                            $delete_column = true;
                        }
                    }
                    // Check if the $thirdDimension array contains null
                    if ($delete_column) {
                        //Delete the column
                        echo "Deleting column";
                        unset($this->requirements[$key1][$key2]);
                    }
                }
            }
            // If at least one row is empty, then all requirements are met
            if (empty($this->requirements[$key1])) {
                //Mark the row for deletion
                echo "Deleting row";
                $this->requirements[$key1] = null;
            }
        }
        // Check if the $row array is empty
        if (in_array(null, $this->requirements) && $this->credits <= 0) {
            // delete the entire $requirements array
            unset($this->requirements);
            echo "Deleted entire reqs";
        }
    }

    public function isComplete(): bool
    {
        return $this->credits == 0 && empty($this->requirements);
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
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('math115', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('math116', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis275', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('imse317', 3, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('math227', 3, array())
                )
            )
        ),
    )
);

// Make a section with the requirements as an array of courses for cis core
$cis_core = new Section(28,
    array(
        //row - One row must get deleted to complete the section
        array(
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis150', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis200', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis310', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis350', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis375', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis427', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis450', 4, array())
                )
            )
        ),
    )
);

// Make a section with the requirements as an array of courses for the cs concentration
$cs = new Section(41,
    array(
        //row - One row must get deleted to complete the section
        array(
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('science-course', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis306', 4, array())
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis296', 3, array()),
                    new Course('cis297', 3, array()),
                    new Course('cis298', 3, array()),
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis405', 4, array()),
                    new Course('cis479', 4, array()),
                )
            ),
            //column - must take all columns to complete the row
            array(
                //thirdDimension - finish one of these to complete the column
                array(
                    //courses - can take just one
                    new Course('cis479', 4, array()),
                    new Course('engr400', 4, array()),
                    new Course('ent400', 4, array()),
                    new Course('imse421', 4, array())
                )
            ),
        ),
    )
);

// Global variable to hold the list of sections
$sections = array($wc, $ns, $ms, $cis_core, $cs);


