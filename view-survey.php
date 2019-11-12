<?php
require_once 'partials/header.php';

require_once 'partials/dbconnection.php';

if ($result=mysqli_query($con, "SELECT surveyName FROM surveys WHERE username='".$_SESSION['username']."' AND Id =".$_GET['id']."")){
    $row = mysqli_fetch_assoc($result);
    echo "<h2>$row[surveyName]</h2>";
}
else
{
    header('sign-in.php');
}
require_once 'partials/footer.php';
?>