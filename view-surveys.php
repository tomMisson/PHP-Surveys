<?php
    require_once 'partials/header.php'; 

    if(isset($_SESSION['loggedIn']))
    {
        echo "<h2>Your surveys</h2>";

        echo "<article><p>&#10010; Create new survey</p></article>";
        require_once 'partials/dbconnection.php';//Opens a db connection

        if ($result=mysqli_query($con, "SELECT Id, surveyName FROM surveys WHERE username='".$_SESSION['username']."'")){
            // determine number of rows result set 
            $n = mysqli_num_rows($result);
            

            for($i=0;$i<$n;$i++)
            {
                $row = mysqli_fetch_assoc($result);
                echo<<<_END
                <a href='view-survey.php?id=$row[Id]'>
                <article>
                    <input readonly type='text' value='$row[surveyName]'></input>
                </article>
                </a>
_END;
            }
        }
    }
    else{
        header("Location: sign-in.php");
    }

    require_once 'partials/footer.php';
?>