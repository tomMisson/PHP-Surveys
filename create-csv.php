<?php

if(isset($_GET['id']))
{
    $fh = fopen("php://output", "w");
    $data = array();
    $headers = array();
    require_once 'partials/dbconnection.php';
    if($resultTitles = mysqli_query($con, "SELECT DISTINCT title FROM questions INNER JOIN answers ON answers.question = questions.id WHERE questions.survey = $_GET[id]"))
    {
        for($i =0; $i<mysqli_num_rows($resultTitles); $i++)
        {
            $row = mysqli_fetch_assoc($resultTitles);
            array_push($headers, $row['title']);
        }
        fputcsv($fh, $headers);
    }
    
    if($resultData = mysqli_query($con, "SELECT answer FROM answers INNER JOIN questions ON answers.question = questions.id WHERE questions.survey = $_GET[id]"))
    {
        for($i=0; $i<mysqli_num_rows($resultData); $i++)
        {
            $row = mysqli_fetch_assoc($resultData);
            if($i%mysqli_num_rows($resultTitles)==0 && $i>0)
            {
                fputcsv($fh, $data);
                $data = array();
                array_push($data, $row['answer']);
            }
            else{
                array_push($data, $row['answer']);
            }
        }
        fputcsv($fh, $data);
    }

    fclose($fh);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv";');

}
else{
    header(403);
}

?>