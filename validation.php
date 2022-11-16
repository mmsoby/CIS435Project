<?php
$s = "select * from Users where username = '"
     . $_POST['user'].
     "' and password = '"
     .$_POST['password']
     ."'";

$result = mysqli_query($con, $s);

if ($row = mysqli_fetch_row($result))
{
  // row fecthed, user found
  $user_id = $row['user_id']; // Let expect that usertable has user_id column
  $_SESSION['current_user_id'] = $user_id;
}
else
{
   echo "<script>";
   echo "alert('Incorrect Username or Password');";
   echo "window.location.replace('login.html');";
   echo "</script>";
   exit();
}

header("Location: admin.php");
?>