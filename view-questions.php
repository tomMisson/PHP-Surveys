<?php
require_once 'partials/builder-viewer-header.php';

if(isset($_SESSION['surveyID']))
{
    echo "<h2>Viewer</h2>";
}
else
{
    header('Location: index.php');
}


?>