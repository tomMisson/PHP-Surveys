<?php

    $con = mysqli_connect("localhost", "root", "");
    if(!$con)
    {
        die("SQL error");
    }
    else{
        ///////////////////////////////
        //// CREATES DB ///////////////
        ///////////////////////////////

        if(mysqli_query($con, "CREATE DATABASE IF NOT EXISTS questionsanswered"))
        {
            echo "<h1>CREATED DB</h1><br/><br/>";
        }

        mysqli_select_db($con, "questionsanswered");
        
        if(mysqli_query($con,"DROP TABLE users") AND mysqli_query($con,"DROP TABLE surveys"))
        {
            echo "<p>Dropped tables</p>";
        }
        

        ///////////////////////////////
        //// CREATES USERS TABLE///////
        ///////////////////////////////

        $currentQuery = "CREATE TABLE IF NOT EXISTS users(
            usrname VARCHAR(50) PRIMARY KEY,
            pswd VARCHAR(50) NOT NULL,
            privileges VARCHAR(5) NOT NULL,
            firstname VARCHAR(50) NOT NULL, 
            lastname VARCHAR(50) NOT NULL, 
            email VARCHAR(50) NOT NULL, 
            dob DATE NOT NULL, 
            telephoneNumber VARCHAR(13) NOT NULL)";

        if(mysqli_query($con,$currentQuery))
        {
            echo "CREATED Users<br/><br/>";
        }

        ///////////////////////////////
        //// CREATES SURVEYS TABLE/////
        ///////////////////////////////

        $currentQuery = "CREATE TABLE IF NOT EXISTS surveys(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            surveyName VARCHAR(100) NOT NULL,
            username VARCHAR(50) NOT NULL,
            sharable  BOOLEAN NOT NULL,
            CONSTRAINT `user-survey-link`
                FOREIGN KEY (username) REFERENCES users (usrname)
                ON DELETE CASCADE
                ON UPDATE RESTRICT)";

        if(mysqli_query($con,$currentQuery))
        {
            echo "CREATED Surveys<br/><br/>";
        }

        ///////////////////////////////
        //// INSERTS USERS DATA////////
        ///////////////////////////////

        if(mysqli_query($con,"INSERT INTO users(usrname,pswd, privileges,firstname,lastname, email,dob,telephoneNumber) VALUES ('admin', 'E5E9FA1BA31ECD1AE84F75CAAA474F3A663F05F4', 'admin',  'Super', 'Last', '11tmisson@gmail.com', '1999-12-25','+447542274199'),('tom', '90FA18F75036F7A6833022AB246C6EE47000912F', 'user','Tom', 'Misson', '11tmisson@gmail.com', '1999-12-25','+447542274199'),('test', '90FA18F75036F7A6833022AB246C6EE47000912F', 'user','Dummy', 'User', '11tmisson@gmail.com', '1999-12-25','+447542274199')"))
        {
            echo "Inserted Users<br/><br/>";
        }
        

        if(mysqli_query($con,"INSERT INTO surveys(surveyName, username, sharable) VALUES ('Dummy Survey', 'tom', true), ('Second Survey', 'tom', false), ('Dummy Survey', 'admin', false)"));
        {
            echo "Inserted Surveys<br/><br/>";
        }


        header('index.php');
    }
?>