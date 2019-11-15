<?php
require_once 'partials/header.php';

require_once 'partials/dbconnection.php';

if(isset($_SESSION['loggedIn']))
{
    if ($result=mysqli_query($con, "SELECT surveyName,sharable, username FROM surveys WHERE username='$_SESSION[username]' AND Id = '$_GET[id]'")){
        $row = mysqli_fetch_assoc($result);
        
        if($row['username']==$_SESSION['username'])
        {
            echo "<h2>$row[surveyName]</h2>";
        }
        elseif($row['sharable']==1)
        {
            echo "Viewer Mode (logged in)";
        }
        else
        {
            echo "Survey Not Shared";
        }
    }
    else{
        echo "<p class='error'>SQL error</p>";
    }
}
else
{
    if ($result=mysqli_query($con, "SELECT surveyName,sharable FROM surveys WHERE Id =".$_GET['id']."")){
        $row = mysqli_fetch_assoc($result);

        if($row['shareable']==1)
        {
            echo "Viewer Mode (not logged in)";
        }
        else{
            echo "Survey Not Shared";
        }
    }
    else{
        echo "<p class='error'>SQL error</p>";
    }
}

require_once 'partials/footer.php';
?>