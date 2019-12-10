<?php

if(isset($_GET['id']) && isset($_GET['ursid']))
{
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv";');

    $resultTitles = mysqli_query($con, "SELECT DISTINCT title FROM questions INNER JOIN answers ON answers.question = questions.id WHERE questions.survey = $_GET[surveyID]");
    $resultData = mysqli_query($con, "SELECT answer FROM answers INNER JOIN questions ON answers.question = questions.id WHERE questions.survey = $_GET[surveyID]");

    $data = array();
    $headers = array();
    for($i =0; $i<mysqli_num_rows($resultTitles); $i++)
    {
        $row = mysqli_fetch_assoc($resultTitles);
        array_push($headers, $row['title']);
    }
    for($i=0; $i<mysqli_num_rows($resultData); $i++)
    {
        $row = mysqli_fetch_assoc($resultData);
        array_push($data, $row['answer']);
    }

    $fh = fopen("php://output", "w");

    fputcsv($fh, $headers);
    fputcsv($fh, $data);

    fclose($fh);

}

?>