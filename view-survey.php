<?php
require_once 'partials/header.php';

require_once 'partials/dbconnection.php';


if ($result=mysqli_query($con, "SELECT surveyName,sharable, username FROM surveys WHERE Id = '$_GET[id]'")){
    $row = mysqli_fetch_assoc($result);

    if(isset($_SESSION['username']))
    {
        if($row['username']==$_SESSION['username'])
        {
            echo "<h2>$row[surveyName]</h2>";
        }
        if($row['username']!=$_SESSION['username'] and $row['sharable']==1)
        {
            echo "<p>Signed in viewer of another persons survey</p>";
        }
    }
    else
    {
        if($row['sharable']==1)
        {
            echo "<p>Non signed in viewer</p>";
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