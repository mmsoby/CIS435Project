<?php
$files = scandir('Resources/CurriculumSheets/');

echo '<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

foreach($files as $file) {
  //do your work here

  echo "<a class= 'dropdown-item' href='Resources/CurriculumSheets/" . $file . "'>" . $file ."</a>";
}

echo "</div></div>";
?>


