<?php
$files = scandir('Resources/CurriculumSheets/');

echo '<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle text-black" style="background-color:#FFCB05 !important" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Download!
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

foreach($files as $file) {
  //do your work here
  if ($file != "." && $file != "..") {
  echo "<a class= 'dropdown-item' href='Resources/CurriculumSheets/" . $file . "' download='Resources/CurriculumSheets/". $file ."'>" . $file ."</a>";
  }
}

echo "</div></div>";
?>


