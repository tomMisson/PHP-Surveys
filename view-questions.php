<?php
require_once 'partials/builder-viewer-header.php';

if(isset($_POST['submit']))
{
    $i=0;
    $result = mysqli_query($con,"SELECT * FROM questions WHERE survey='$_SESSION[surveyID]'");
    while($row = mysqli_fetch_array($result))
    {
        $i++;
        $answerQuestionNumber = $i.'-answer';
        $answer = $_POST[$answerQuestionNumber];

        if($answer != "")
        {
            if($row['type'] == 'text')
            {
                $answer = validateString(sanitise($answer),$row['minlength'], $row['maxlength']);
            }
            else if($row['type'] == 'number')
            {
                $answer = validateInt(sanitise($answer),$row['minlength'], $row['maxlength']);
            }
            else if($row['type'] == 'date')
            {
                $answer = validateDate(sanitise($answer));
            }
            else if($row['type'] == 'email')
            {
                $answer = validateEmail(sanitise($answer));
            }
            else if($row['type'] == 'url')
            {
                $answer = validateURL(sanitise($answer));
            }
            else if($row['type'] == 'tel')
            {
                $answer = validateTel(sanitise($answer));
            }
            else if($row['type'] == 'color')
            {
                $answer = validateCol(sanitise($answer));
            }
            else{
                $answer = sanitise($answer);
            }
            if(mysqli_query($con,"INSERT INTO answers(question, answer) VALUES ($row[id], '$answer')"))
            {
                header('Location: completed-response.php');
            }
            else
            {
                echo "<p class='error'>SQL error</p>";
            }
        }
        else{

        }
    }
}

if(isset($_SESSION['surveyID']))
{
    if($result = mysqli_query($con,"SELECT title,type, maxlength, minlength, requiredQuestion FROM questions WHERE survey='$_SESSION[surveyID]'"))
    {
        $i=0;
        echo "<form method='POST'>";

        while($row = mysqli_fetch_array($result))
        {
            $i++;
            echo<<<_END
                <section id="question-$i" class="question">
                    <h2>$row[title]</h2>
_END;

            if($row['requiredQuestion'])
            {
                echo "<input required name='$i-answer' minlength='$row[minlength]' maxlength='$row[maxlength]' type='$row[type]'>";
                echo "<br><p  style='display:inline' class='error'>Required</p>";
            }
            else
            {
                echo "<input name='$i-answer' minlength='$row[minlength]' maxlength='$row[maxlength]' type='$row[type]'>";
            }
            echo "</section>";
        }
    }

    echo "<input type ='submit' name='submit'></form>";
}
else
{
    header('Location: index.php');
}


?>