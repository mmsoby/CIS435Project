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
//
// $sql = "INSERT INTO Answers (questionID, answer)"
//     . "VALUES ('" . $_POST['questionID'] . "', '" . $_POST['answer'] . "')";
//

// Check if answer is already in database
$result = mysqli_query($conn, "SELECT answerID
                               FROM Answers
                               WHERE answerID = '" . $_POST['answer'] . "'");

// Must add answer to answer table if it is not already there
if (mysqli_num_rows($result) == 0) {
    $sql = "INSERT INTO Answers (answer)"
        . "VALUES ('" . $_POST['answer'] . "')";
    mysqli_query($conn, $sql);
    $result3 = mysqli_query($conn, "SELECT MAX(answerID) as answerID
                                   FROM Answers");
}

// Check if answer is already in QnA table
$result2 = mysqli_query($conn, "SELECT *
                                FROM QnA
                                WHERE questionID = '" . $_POST['questionID'] . "'");

// Set result4 to answerID
if (mysqli_num_rows($result) > 0) {
    $result4 = $result;
} else {
    $result4 = $result3;
}

// Add question to QnA table if not there, else update it (multiple answers not allowed)
if (mysqli_num_rows($result2) == 0) {
    $sql = "INSERT INTO QnA (questionID, answerID)"
        . "VALUES ('" . $_POST['questionID'] . "', '" . mysqli_fetch_array($result4)['answerID'] . "')";
    mysqli_query($conn, $sql);
} else {
    $sql = "UPDATE QnA
            SET answerID = '" . mysqli_fetch_array($result4)['answerID'] . "'
            WHERE questionID = '" . $_POST['questionID'] . "'";
    mysqli_query($conn, $sql);
}


if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}


mysqli_close($conn);

header("Location: admin.php");
?>