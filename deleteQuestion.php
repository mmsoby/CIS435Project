<?php
$servername = "141.215.80.154";
$username = "group15";
$password = "n0bAA@efFVB";
$dbname = "group15_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to delete a record based on questionID
$sql = "DELETE FROM FAQ WHERE questionID = " . $_POST['questionID2'];

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}


mysqli_close($conn);

header("Location: admin.php");
?>