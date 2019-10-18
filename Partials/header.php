<?php

session_start();

echo <<<_END

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
<h1>Questions? Answered</h1>
<nav>
    <ul>
        <li><a alt="Link to home" href="index.php">Home</a></li>
        <li><a alt="Link to sign in" href="sign-in.php">Sign in</a></li>
    </ul>
</nav>
_END

?>