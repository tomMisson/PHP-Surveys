<?php

    require_once 'partials/dbconnection.php';

    query("CREATE DATABASE IF NOT EXISTS questionsanswered");
    echo "CREATED DB<br/><br/>";

    ///////////////////////////////
    //// CREATES USERS TABLE///////
    ///////////////////////////////

    query("DROP TABLE IF EXISTS users");

    $currentQuery = "CREATE TABLE IF NOT EXISTS users(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        usrname VARCHAR(50) NOT NULL,
        pswd VARCHAR(50) NOT NULL,
        firstname VARCHAR(50) NOT NULL, 
        lastname VARCHAR(50) NOT NULL, 
        email VARCHAR(50) NOT NULL, 
        dob DATE NOT NULL, 
        telephoneNumber VARCHAR(13) NOT NULL)";

    query($currentQuery);
    echo "CREATED Users<br/><br/>";

    ///////////////////////////////
    //// INSERTS USERS DATA////////
    ///////////////////////////////

    query("INSERT INTO users(usrname,pswd,firstname,lastname, email,dob,telephoneNumber) VALUES ('SU', 'password', 'Super', 'Last', '11tmisson@gmail.com', '1999-12-25','+447542274199')");
    query("INSERT INTO users(usrname,pswd,firstname,lastname, email,dob,telephoneNumber) VALUES ('tom', 'tom123', 'Tom', 'Misson', '11tmisson@gmail.com', '1999-12-25','+447542274199')");
    echo "Inserted Users";
?>