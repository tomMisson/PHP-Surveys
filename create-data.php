<?php

    $con = mysqli_connect("localhost", "root", "");
    if(!$con)
    {
        die("SQL error");
    }
    
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

    mysqli_query($con,"INSERT INTO users(usrname,pswd,firstname,lastname, email,dob,telephoneNumber) VALUES ('SU', 'C8FED00EB2E87F1CEE8E90EBBE870C190AC3848C', 'Super', 'Last', '11tmisson@gmail.com', '1999-12-25','+447542274199'),('tom', '90FA18F75036F7A6833022AB246C6EE47000912F', 'Tom', 'Misson', '11tmisson@gmail.com', '1999-12-25','+447542274199')");
    echo "Inserted Users<br/><br/>";

    mysqli_query($con,"INSERT INTO surveys(surveyName, username) VALUES ('Dummy Survey', 'tom'), ('Second Survey', 'tom'), ('Dummy Survey', 'SU')");
    echo "Inserted Surveys<br/><br/>";
?>