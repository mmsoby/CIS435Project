<?php
$files = scandir('Resources/CurriculumSheets/');

foreach($files as $file) {
  //do your work here
  if ($file != "." && $file != "..") {
  echo "<option value=' ". $file ."' >" . $file . "</option>";
  }
  }
}

?>


