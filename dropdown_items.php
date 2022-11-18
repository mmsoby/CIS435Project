<?php
$files = scandir('Resources/CurriculumSheets/');

foreach($files as $file) {
  //do your work here
  if ($file != "." && $file != "..") {
  echo "<a class= 'dropdown-item'>" . $file ."</a>";
  }
}

echo "</div></div>";
?>


