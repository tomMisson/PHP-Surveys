<?php
//Initailises global variables with default values
$server = "localhost";
$username = "root";
$password = "";

//Checks to see if the database exists and if not creates a new questionsanswered database
function query($SQL)
{   
    global $server, $username, $password;//gets the global instance and pulls it in to scope
    
    if($SQL!="")
    {
        $con = mysqli_connect($server, $username, $password, "questionsanswered");
        mysqli_select_db ($con , "questionsanswered");

        //Tests if successful connection
        if (!$con) {
            die("Connection error: "+ $mysqli_connect_error);
        }
        $result = mysqli_query($con, $SQL);
        

    }
    
    mysqli_close($con);
    return $result;//Returns result of query
}



?>