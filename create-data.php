<?php

    $con = mysqli_connect("localhost", "root", "");

    ///////////////////////////////
    //// CREATES DB ///////////////
    ///////////////////////////////

    if(mysqli_query($con, "CREATE DATABASE questionsanswered"))
    {
        echo "<h1>CREATED DB</h1><br/><br/>";
    }

    mysqli_select_db($con, "questionsanswered");
    
    if(mysqli_query($con,"DROP TABLE users"))
    {
        echo "<p>Dropped table users</p>";
    }
    
    if(mysqli_query($con,"DROP TABLE surveys"))
    {
        echo "<p>Dropped table surveys</p>";
    }

    if(mysqli_query($con,"DROP TABLE questiontype"))
    {
        echo "<p>Dropped table questiontype</p>";
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
    // CREATES questions TABLE ////
    ///////////////////////////////

    $currentQuery = "CREATE TABLE IF NOT EXISTS questions(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        survey INT(6) UNSIGNED NOT NULL,
        title VARCHAR(100) NOT NULL,
        type VARCHAR(50) NOT NULL,
        maxlength INT(3) UNSIGNED NOT NULL,
        minlength INT(3) UNSIGNED NOT NULL,
        requiredQuestion BOOLEAN NOT NULL,
        CONSTRAINT `survey-question-link`
            FOREIGN KEY (survey) REFERENCES surveys(id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
        )";

    if(mysqli_query($con,$currentQuery))
    {
        echo "CREATED questions<br/><br/>";
    }

    ///////////////////////////////
    // CREATES answers TABLE //////
    ///////////////////////////////

    $currentQuery = "CREATE TABLE IF NOT EXISTS answers(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        question INT(6) UNSIGNED NOT NULL,
        answer VARCHAR(500) NOT NULL,
    
        CONSTRAINT `question-answer-link`
            FOREIGN KEY (question) REFERENCES questions(id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
        )";

    if(mysqli_query($con,$currentQuery))
    {
        echo "CREATED answers<br/><br/>";
    }

    ///////////////////////////////
    ////// INSERTS DATA   /////////
    ///////////////////////////////

    if(mysqli_query($con,"INSERT INTO users(usrname,pswd, privileges,firstname,lastname, email,dob,telephoneNumber) VALUES ('admin', 'E5E9FA1BA31ECD1AE84F75CAAA474F3A663F05F4', 'admin',  'Super', 'Last', '11tmisson@gmail.com', '1999-12-25','+447542274199'),('tom', '90FA18F75036F7A6833022AB246C6EE47000912F', 'user','Tom', 'Misson', '11tmisson@gmail.com', '1999-12-25','+447542274199'),('test', '90FA18F75036F7A6833022AB246C6EE47000912F', 'user','Dummy', 'User', '11tmisson@gmail.com', '1999-12-25','+447542274199')"))
    {
        echo "Inserted Users<br/><br/>";
    }
    
    if(mysqli_query($con,"INSERT INTO surveys(surveyName, username, sharable) VALUES ('Favorites', 'tom', true), ('Blank survey', 'tom', false), ('Basic details', 'admin', false), ('Animals', 'test', false)"));
    {
        echo "Inserted Surveys<br/><br/>";
    }

    if(mysqli_query($con,"INSERT INTO questions(survey,title,type,minlength,maxlength,requiredQuestion) VALUES (1, 'Favorite word?', 'text', 1, 45, true),(1, 'Favorite date?', 'date', 0, 150, false), (1, 'Favorite number?', 'number', 1, 150, false), (1, 'Favorite animal?', 'text', 3, 150, false), (1, 'Favorite chocolate?', 'text', 3, 150, true),(3, 'Name?', 'text', 2, 150, true), (3, 'Date of birth?', 'date', 0, 150, true), (3, 'Website?', 'url', 2, 150, true), (3, 'Phone number?', 'tel', 9, 15, true)"))
    {
        echo "Inserted questions<br/><br/>";
    }

    if(mysqli_query($con,"INSERT INTO answers(question, answer) VALUES (1, 'Hippo'), (2, '1999-12-25'), (3, '0'), (4, 'Chicken'), (5, 'Cadbury'), (1, 'Log'), (2, '1970-01-01'), (3, ' '), (4, ' '), (5, 'Lint')"))
    {
        echo "Inserted answers<br/><br/>";
    }


    header('Location: index.php');
?>