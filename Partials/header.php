<?php

session_start();

echo<<<_END

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Questions? Answered</title>
</head>
<body>
<header>
<h1>Questions? Answered</h1>
<nav>
    <ul>
        <li><a alt="Link to home" href="index.php">Home</a></li>
_END;

if(isset($_SESSION['loggedIn']))
{
    echo "<li><a alt='Link to view surveys' href='view-surveys.php'>My surveys</a></li>";
    echo "<li><a alt='Link to account details' href='view-account.php'>My account</a></li>";
    echo "<li><a alt='Link to sign out' href='sign-out.php'>Sign out(".$_SESSION['username'].")</a></li>";
}
else{
    echo "<li><a alt='Link to sign up' href='sign-up.php'>Sign up</a></li>";
    echo "<li><a alt='Link to sign in' href='sign-in.php'>Sign in</a></li>";
}

echo" 
    </ul>
</nav>
</header>
<main>
";

?>