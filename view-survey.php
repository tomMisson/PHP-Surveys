<?php
require_once 'partials/header.php';

require_once 'partials/dbconnection.php';


if ($result=mysqli_query($con, "SELECT * FROM surveys WHERE Id = '$_GET[id]'")){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['surveyID'] = $row['id'];
    $_SESSION['owner'] = false;

    if(isset($_SESSION['username']))
    {
        if($row['username']==$_SESSION['username'] or $_SESSION['admin'])
        {
            $_SESSION['owner'] = true;
            header('Location: survey-builder.php');
        }
        if($row['username']!=$_SESSION['username'] and $row['sharable']==1 and $_SESSION['admin']==false)
        {
            header('Location: view-questions.php');
        }
        if($row['sharable']==0 and $row['username']!=$_SESSION['username'] and $_SESSION['admin']==false){
            echo "<p>Survey not shared</p>";
        }
    }
    else
    {
        if($row['sharable']==1)
        {
            header('Location: view-questions.php');
        }
        else
        {
            echo "<p class='error'>Survey not shared.</p>";
        }
    }
}
else{
    echo "<p class='error'>SQL error</p>";
}



require_once 'partials/footer.php';
?>