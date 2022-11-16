<?php
$files = scandir('Resources/CurriculumSheets/');
foreach($files as $file) {
  //do your work here

  echo "<li><a href='Resources/CurriculumSheets/$file'>$file</a></li>";
}
// <button class="btn btn-primary text-black " style="background-color:#FFCB05 !important" type="submit">
//                    <a style="color: inherit; text-decoration: none;"
//                       href="Resources/CurriculumSheets/Fall2018DataScience.pdf" target="_blank"
//                       download="Fall 2018 Data Science.pdf">Fall 2018 Data Science Curriculum</a>
//                </button>
//
//                <br>
//                <br>
?>


