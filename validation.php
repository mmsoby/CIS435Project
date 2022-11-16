<?php
$servername = "141.215.80.154";
$username = "group15";
$password = "n0bAA@efFVB";
$dbname = "group15_db";
$postedAt = date("Y-m-d H:i:s");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$s = "select * from Users where username = '"
     . $_POST['user'].
     "' and password = '"
     .$_POST['password']
     ."'";

$result = mysqli_query($conn, $s);

if ($row = mysqli_fetch_row($result))
{
  // row fecthed, user found
  echo $row[0];
  $user_id = $row['username'];
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