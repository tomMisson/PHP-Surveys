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
        <link rel="stylesheet" type="text/css" href="./CSS/styles.css">
        <link rel="icon" href="Media/logo.png">
        <title>Questions? Answered</title>
    </head>
    <body>
    <header>
    <h1>Questions? Answered</h1>
    <nav>
        <ul>
_END;

if(isset($_SESSION['loggedIn']))
{
    require_once 'partials/dbconnection.php';
    $admin = mysqli_query($con, "SELECT usrname FROM users WHERE privileges='admin'");

    while ($row = mysqli_fetch_assoc($admin)) {
        if($row['usrname'] == $_SESSION['username'])
        {
            echo "<li class='navButtons'><a alt='Admin tools' href='admin.php'>Admin tools</a></li>";
        }
    }
    echo "<li class='navButtons'><a alt='Link to view surveys' href='view-surveys.php'>My surveys</a></li>";
    echo "<li class='navButtons'><a alt='Link to account details' href='view-account.php'>My account</a></li>";
    echo "<li class='navButtons'><a alt='Link to sign out' href='sign-out.php'>Sign out($_SESSION[username])</a></li>";
}
else{
    echo "<li class='navButtons'><a alt='Link to home' href='index.php'>Home</a></li>";
    echo "<li class='navButtons'><a alt='Link to read about similar sites' href='competitors.php'>Competitors</a></li>";
    echo "<li class='navButtons'><a alt='Link to sign up' href='sign-up.php'>Sign up</a></li>";
    echo "<li class='navButtons'><a alt='Link to sign in' href='sign-in.php'>Sign in</a></li>";
}

echo" 
    </ul>
</nav>
</header>
<main>
";

?>