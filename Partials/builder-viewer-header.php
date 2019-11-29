<?php
session_start();
require_once 'helper.php';

echo<<<_END

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="./CSS/styles-viewer-bulder.css">
        <title>Questions? Answered</title>
    </head>
    <body>
    <header>
_END;

    require_once 'dbconnection.php';
    if ($result=mysqli_query($con, "SELECT surveyName FROM surveys WHERE id = '$_SESSION[surveyID]'")){
        $row = mysqli_fetch_assoc($result);
        echo "<section><h1>$row[surveyName]</h1></section>";
    }
    else
    {
        echo "<p class=error>SQL ERROR</p>";
        var_dump($con);
    }
    echo "</header>
<main>
";

?>