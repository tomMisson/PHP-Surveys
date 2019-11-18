<?php

require_once 'partials/header.php';

if(isset($_SESSION['loggedIn']))
{
    if($_GET['create'] == 'y')
    {
        echo<<<_END
            <form method='POST'>
                <input type="text" name="name" placeholder="Survey name"><br> 
                <label for="shared">Shared</label>
                <input type="checkbox" name="shared"><br>
                <input type="submit" name="create" value="Create">
            </form>
_END;

    }
    if(isset($_POST['create']))
    {
        require_once 'partials/dbconnection.php';
        if($result = mysqli_query($con, "SELECT Id FROM surveys ORDER BY Id DESC LIMIT 1"))
        {
            $row = mysqli_fetch_assoc($result);
            $nextSurveyID = $row['Id']+1;

            if(isset($_POST['shared']) and $_POST['shared']=="on")
            {
                $share = 1;
            }
            else
            {
                $share = 0;
            }

            if(mysqli_query($con, "INSERT INTO surveys(id, surveyName, username, sharable) VALUES ($nextSurveyID, '$_POST[name]', '$_SESSION[username]', $share)"))
            {
                header("Location: view-survey.php?id=$nextSurveyID");
            }
            else
            {
                echo $nextSurveyID." ". $_POST['name'] . " " . $_SESSION['username'] . " ". $share;
                echo "<p class='error'>SQL error</p>";
            }
        }
    }
}
else{
    echo "<p class='error'>You need to be signed in to view this page <a href='sign-in.php'>click here to sign in</a></p>";
}

require_once 'partials/footer.php';

?>