<?php
session_start();
require_once 'helper.php';
require_once 'dbconnection.php';

if(isset($_POST['shared']))
{
    if($_POST['shared'] == 'Shared')
    {
        mysqli_query($con, "UPDATE surveys SET sharable=0 WHERE id='$_SESSION[surveyID]'");
    }
    else
    {
        mysqli_query($con, "UPDATE surveys SET sharable=1 WHERE id='$_SESSION[surveyID]'");
    }
}

echo<<<_END

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- local stylesheet and icon import -->
        <link rel="icon" href="http://catchingfire.ca/wp-content/uploads/2016/09/question-mark-square-01.png">
        <link rel="stylesheet" type="text/css" href="./CSS/styles-viewer-bulder.css">

        <!-- JQuery import -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!--Load the AJAX API for google charts-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        
        <title>Questions? Answered</title>
    </head>
    <body>
    <header>
_END;

    if(isset($_SESSION['surveyID']))
    {
        if ($result=mysqli_query($con, "SELECT surveyName,username,sharable FROM surveys WHERE id = '$_SESSION[surveyID]'")){
            $row = mysqli_fetch_assoc($result);
            echo "<section>
                <h1>$row[surveyName]</h1><br/>";
                
                if(isset($_SESSION['loggedIn']))
                {
                    $pageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
                    if($pageName == 'survey-builder.php')
                    {
                        echo "<a href='view-questions.php'>View survey</a>";
                        echo "<a href='view-responses.php'>Responses</a>";
                        echo " 
                            <form style='display:inline' method='POST'>";
                            if($row['sharable'])
                            {
                                echo "<input id='shared' type='submit' value='Shared' name='shared'>";
                            }
                            else
                            {
                                echo "<input id='notShared' type='submit' value='Not Shared' name='shared'>";
                            }
                            echo "
                            <a href='view-surveys.php'>Back</a>
                            </form>";
                    }
                    else if($pageName == 'view-questions.php')
                    {
                        if($row['username'] == $_SESSION['username'] or $_SESSION['admin'])
                        {
                            echo "<a href='survey-builder.php'>Edit survey</a>";
                            echo "<a href='view-responses.php'>Responses</a>";
                            echo " 
                                <form style='display:inline' method='POST'>";
                                if($row['sharable'])
                                {
                                    echo "<input id='shared' type='submit' value='Shared' name='shared'>";
                                }
                                else
                                {
                                    echo "<input id='notShared' type='submit' value='Not Shared' name='shared'>";
                                }
                                echo "
                                <a href='view-surveys.php'>Back</a>
                                </form>";
                        }
                    }
                    else if($pageName == 'completed-response.php')
                    {
                        echo "<a href='survey-builder.php'>Edit survey</a>";
                        echo "<a href='view-responses.php'>Responses</a>";
                        echo " 
                            <form style='display:inline' method='POST'>";
                            if($row['sharable'])
                            {
                                echo "<input id='shared' type='submit' value='Shared' name='shared'>";
                            }
                            else
                            {
                                echo "<input id='notShared' type='submit' value='Not Shared' name='shared'>";
                            }
                            echo "
                            <a href='view-surveys.php'>Back</a>
                            </form>";
                    }
                    else if($pageName == 'view-responses.php')
                    {
                        echo "<a href='survey-builder.php'>Edit survey</a>";
                        echo "<a href='view-questions.php'>View survey</a>";
                        echo " 
                            <form style='display:inline' method='POST'>";
                            if($row['sharable'])
                            {
                                echo "<input id='shared' type='submit' value='Shared' name='shared'>";
                            }
                            else
                            {
                                echo "<input id='notShared' type='submit' value='Not Shared' name='shared'>";
                            }
                            echo "
                            <a href='view-surveys.php'>Back</a>
                            </form>";
                    }
                    else
                    {
                        var_dump($pageName);
                    }
                }
            echo "</section>";
        }
        else
        {
            echo "<p class=error>SQL ERROR</p>";
            var_dump($con);
        }
    }
    echo "</header>
<main>
";

?>