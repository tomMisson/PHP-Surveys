<?php

require_once "partials/header.php";

if (!isset($_SESSION['loggedIn']))
{
    echo "You must be logged in to view this page.<br>";
}
else
{
    $_SESSION = array();
    setcookie(session_name(), "", time() - 2592000, '/');
    session_destroy();

    header("Location: index.php");
}

require_once "partials/footer.php";


?>