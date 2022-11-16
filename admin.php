<?php
session_start();
if (!isset($_SESSION['current_user_id']))
{
exit('Your session expired!');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/fontawesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#questionList").load("listQuestionsForAdmin.php");
        });
    </script>
</head>
<body>
<!-- List all questions -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Admin page, answer questions</h1>
            <p>List of all questions</p>
        </div>
    </div>

    <!--Create a button to list all the questions using the php function-->
    <br>
    <div id="questionList" class="table-responsive"></div>
</div>

<!-- Create a form to Answer a question -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Answer a question</h1>
            <p>Answer a question</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="answerQuestion.php" method="post">
                <div class="form-group">
                    <label for="questionID"></label>
                    <input type="text" class="form-control" id="questionID" name="questionID"
                           placeholder="Enter question ID">
                    <label for="answer"></label>
                    <input type="text" class="form-control" id="answer" name="answer"
                           placeholder="Enter answer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!--Create a form to delete a question-->
    <div class="deleteQuestion">
    <div class="row">
        <div class="col-md-12">
            <h1>Delete a question</h1>
            <p>Delete a question</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="deleteQuestion.php" method="post">
                    <div class="form-group">
                        <label for="questionID2"></label>
                        <input type="text" class="form-control" id="questionID2" name="questionID2"
                               placeholder="Enter question ID">
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


</body>
</html>