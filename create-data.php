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
    // CREATES questiontype TABLE /
    ///////////////////////////////

    $currentQuery = "CREATE TABLE IF NOT EXISTS questiontype(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        questionType VARCHAR(100) NOT NULL,
        maxlength INT(3) UNSIGNED,
        minlength INT(3) UNSIGNED
        )";

    if(mysqli_query($con,$currentQuery))
    {
        echo "CREATED questiontype<br/><br/>";
    }

    ///////////////////////////////
    // CREATES questions TABLE ////
    ///////////////////////////////

    $currentQuery = "CREATE TABLE IF NOT EXISTS questions(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        survey INT(6) UNSIGNED NOT NULL,
        questionType INT(6) UNSIGNED NOT NULL,
        title VARCHAR(100) NOT NULL,
        requiredQuestion BOOLEAN NOT NULL,
        CONSTRAINT `questions-questiontype-link`
            FOREIGN KEY (questionType) REFERENCES questiontype(id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT,
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
    
    if(mysqli_query($con,"INSERT INTO surveys(surveyName, username, sharable) VALUES ('Dummy Survey', 'tom', true), ('Second Survey', 'tom', false), ('Dummy Survey', 'admin', false)"));
    {
        echo "Inserted Surveys<br/><br/>";
    }

    if(mysqli_query($con,"INSERT INTO questiontype(questionType,maxlength,minlength) VALUES ('longTextResponse',500, 0),('shortText',150,0),('number',null,null),('dateResponse',null,null),('email',7,345),('mcq',null,null), ('color',3, 6)"))
    {
        echo "Inserted questiontypes<br/><br/>";
    }

    if(mysqli_query($con,"INSERT INTO questions(survey,questionType,title, requiredQuestion) VALUES (1,2,'Whats your favourite colour?', 1)"))
    {
        echo "Inserted questions<br/><br/>";
    }

    if(mysqli_query($con,"INSERT INTO answer(question, answer) VALUES (1, 'green'),(1, 'green'),(1, 'blue'), (1, 'red')"))
    {
        echo "Inserted questions<br/><br/>";
    }


    header('index.php');
?>