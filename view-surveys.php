<?php
    require_once 'partials/header.php'; 

    if(isset($_SESSION['loggedIn']))
    {
        echo "<h2>Your surveys</h2>";

        require_once 'partials/dbconnection.php';//Opens a db connection

        if ($result=mysqli_query($con, "SELECT Id, surveyName FROM surveys WHERE username='".$_SESSION['username']."'")){
            // determine number of rows result set 
            $n = mysqli_num_rows($result);
            

            for($i=0;$i<$n;$i++)
            {
                $row = mysqli_fetch_assoc($result);
                echo "<article><p>".$row['surveyName']."</p></article>";
            }
        }
    }
    else{
        header("Location: sign-in.php");
    }

    require_once 'partials/footer.php';
?>