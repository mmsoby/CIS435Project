<?php
$files = scandir('Resources/CurriculumSheets/');

echo "<select class='form-select'> <option value='0'>Select a file</option>";



foreach($files as $file) {
  //do your work here
  if ($file != "." && $file != "..") {
  echo "<option value='". $file ."' >" . $file . "</option>";
  }
  }

echo "</select>";

?>


