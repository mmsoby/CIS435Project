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
$result = mysqli_query($conn, "SELECT
                                   question,
                                   Answers.answer AS answers
                               FROM
                                   FAQ
                               LEFT JOIN QnA ON FAQ.questionID = QnA.questionID
                               LEFT JOIN Answers ON Answers.answerID = QnA.answerID");

echo "
<table class='table table-responsive table-bordered'>
<tr>
<th scope='col'>Question</th>
<th scope='col'>Answers</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['question'] . "</td>";
echo "<td>" . $row['answers'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);

?>