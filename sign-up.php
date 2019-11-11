<?php

include_once 'partials/header.php';

if(isset($_POST['submit']))
{
    if($_POST['pswd']==$_POST['pswdConf'])
    {
        $usr = $_POST['usrname'];
        $pswd = sha1($_POST['pswd']);
        $forename = $_POST['Forename'];
        $surname = $_POST['Surname'];
        $email = $_POST['email'];
        $tel = $_POST['telephoneNumber'];
        $dob = $_POST['dob'];

        include_once 'partials/dbconnection.php';

        mysqli_query($con,"INSERT INTO users(usrname,pswd,privileges,firstname,lastname, email,dob,telephoneNumber) VALUES ('$usr', '$pswd', 'user','$forename', '$surname', '$email', '$dob','$tel')");
    
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $usr;

        header('Location: sign-in.php');
    }
    else
    {
        echo "<p class='error'>Passwords don't match, please retype</p>";
    }
}

echo<<<_END

    <h2>Sign up</h2>
    <form action="sign-up.php" method="post">
        <input type="text" name="usrname" placeholder="Username"><br/>
        <input type="password" name="pswd" placeholder="Password" ><br/>
        <input type="password" name="pswdConf" placeholder="Confirm password"><br/><br/>

        <input type="text" name="Forename" placeholder="Forename"><br/>
        <input type="text" name="Surname" placeholder="Surname"><br/><br/>
        
        <input type="email" name="email" placeholder="E-mail"><br/>
        <input type="tel" name="telephoneNumber" placeholder="Phone number"><br/>
        <input type="date" name="dob"><br/><br/>

        <input type="submit" name="submit">
        
    </form> 
_END;

include_once 'partials/footer.php';

?>