<?php
$servername = "141.215.80.154";
$username = "group15";
$password = "n0bAA@efFVB";
$dbname = "group15_db";
$postedAt = date("Y-m-d H:i:s");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO FAQ (question, postedAt)"
    . "VALUES ('" . $_POST['question'] . "', '"  . $postedAt . "')";

mysqli_query($conn, $sql);

// Select highest id
$sql2 = "SELECT MAX(id) FROM FAQ";
$result = mysqli_query($conn, $sql2);

// Insert empty answer into answer array with highest id
$sql3 = "INSERT INTO Answers (id, answer)"
    . "VALUES ('" . $result . "', '')";
mysqli_query($conn, $sql3);



mysqli_close($conn);

header("Location: HelpPage.html");
?>