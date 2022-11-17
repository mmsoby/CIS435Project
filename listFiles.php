<?php
$files = scandir('Resources/CurriculumSheets/');

echo "<div class='dropdown'>
      <button class='btn btn-primary dropdown-toggle' type='button'
      data-toggle='dropdown'>
        Dropdown Example

      <span class='caret'></span></button>
      <ul class='dropdown-menu'>";


foreach($files as $file) {
  //do your work here

  echo "<li><a href='Resources/CurriculumSheets/" . $file . "'>" . $file ."</a></li>";
}

echo "</ul></div>";
?>


