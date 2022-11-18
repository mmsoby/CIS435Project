<?php
$files = scandir('Resources/CurriculumSheets/');

echo "<select class='form-control'>";

foreach($files as $file) {
  //do your work here
  if ($file != "." && $file != "..") {
  echo "<option value='". $file ."' >" . $file . "</option>";
  }
  }
}

echo "</select>";

?>


