<?php
require_once 'partials/builder-viewer-header.php';
$error = false;

if(isset($_POST['delQuestion']))
{
    $id = $_POST['id'];

    if(mysqli_query($con, "DELETE FROM questions WHERE id='$id'"))
    {
        $message = "Deleted question";
    }
    else
    {
        $error = true;
        $message = "SQL error";
    }
}

if(isset($_POST['Submit']))
{
    if(isset($_POST['required']) and $_POST['required']=="on")
    {
        $require = 1;
    }
    else
    {
        $require = 0;
    }
    $title = validateString(sanitise($_POST['name']),3, 300);
    $type = sanitise($_POST['type']);
    $min = validateInt(sanitise($_POST['min']), 0, 3);
    $max = validateInt(sanitise($_POST['max']), 0, 3);

    if(mysqli_query($con,"INSERT INTO questions(survey, title, type, maxlength, minlength, requiredQuestion) VALUES ('$_SESSION[surveyID]', '$title', '$type', '$max', '$min', $require)"))
    {
        $message = "Added $title";
    }
    else
    {
        $message = "SQL error";
        $error = true;
    }
}
if(isset($_SESSION['surveyID']))
{
    if(isset($message))
    {
        if($message=="")
        {
            echo "";
        }
        else{
            if($error)
            {
                echo "<section><h4 class ='error'>$message</h4></section>";
            }
            else{
                echo "<section><h4 class='success'>$message</h4></section>";
            }
    
        }
    }

    echo<<<_END
    <section>
        <form method="POST">
            <input class="qtitle"  minlength="3" maxlength="300" type="text" name='name' placeholder="Question title"><br/>

            <select name="type" id="question-types">
                <option value='text'>Text</option>
                <option value='number'>Number</option>
                <option value='date'>Date</option>
                <option value='email'>Email</option>
                <option value='url'>Website</option>
                <option value='tel'>Phone number</option>
                <option value='color'>Colour</option>
            </select><br/>

            <div id='minMax'>
                <label for="min">Minimum length:</label>
                <input id="min" type="number" name="min" maxlength="3" value="0">
                
                <label for="max">Maximum length:</label>
                <input id="max" type="number" name="max" maxlength="3" value="150"><br/>
            </div>

            <script type="text/javascript">
                $("#question-types").change(function (){
                    var value = $("#question-types").val()
                    if(value==='text'|| value==='number' || value==='url')
                    {
                        if(value==='number')
                        {
                            $("#max").val("3");
                        }
                        else
                        {
                            $("#max").val("150");
                        }
                        $("#minMax").show();
                    }
                    else
                    {
                        $("#minMax").hide();
                    }
                });
            </script>

            <label for='required'>Required: </label>
            <input type="checkbox" name="required"><br>
            
            <input name="Submit" type=submit>
        </form>
    </section>
_END;

    echo "<details><summary>Modify questions</summary>";
    if($result = mysqli_query($con,"SELECT id,title,type, maxlength, minlength, requiredQuestion FROM questions WHERE survey='$_SESSION[surveyID]'"))
    {
        $i=0;
        while($row = mysqli_fetch_array($result))
        {
            $i++;
            echo<<<_END
                <section class="question">
                <form method="POST">
                    <h2>$row[title]</h2>
                    <input id="question" readonly name='id' value='$row[id]'>
_END;
                if($row['requiredQuestion'])
                {
                    echo "<p  style='display:inline' class='error'>*</p>";
                }

                echo<<<_END
                    <br/><input type="submit" value="Delete" name="delQuestion">
                </form>
_END;
            echo "</section>";
        }
    }
    else
    {
        echo "<p class='error'>SQL ERROR</p>";
    }
    echo "</details>";
}
else
{
    header('Location: index.php');
}

?>