<?php

include_once 'partials/header.php';

if(isset($_POST['submit']))
{
    if($_POST['pswd']==$_POST['pswdConf'])
    {
        $usr = sanitise(validateString($_POST['usrname'], 2,50));
        $pswd = sha1(sanitise(validateString($_POST['pswd'], 6,50)));
        $forename = sanitise(validateString($_POST['Forename'], 1, 50));
        $surname = sanitise(validateString($_POST['Surname'], 1, 50));
        $email = sanitise(validateString($_POST['email'],5,50));
        $tel = sanitise(validateString(validateEmail($_POST['telephoneNumber']), 11, 13));
        $dob = sanitise(validateDate($_POST['dob']));

        include_once 'partials/dbconnection.php';

        if(mysqli_query($con,"INSERT INTO users(usrname,pswd,privileges,firstname,lastname, email,dob,telephoneNumber) VALUES ('$usr', '$pswd', 'user','$forename', '$surname', '$email', '$dob','$tel')"))
        {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $usr;
            header('Location: sign-in.php');
        }
        else{
            echo "<p class='error'>Sign up failed</p>";
        }
       
    }
    else
    {
        echo "<p class='error'>Passwords don't match, please retype</p>";
    }
}

echo<<<_END

    <h2>Sign up</h2>
    <form action="sign-up.php" method="post">
        <input title="Username for account" type="text" minlength='2' maxlength='50' name="usrname" required placeholder="Username"><br/>
        <input title="Password for account" type="password" minlength='6' maxlength='50' name="pswd" required placeholder="Password" ><br/>
        <input title="Confirm password" type="password" minlength='6' maxlength='50' name="pswdConf" required placeholder="Confirm password"><br/><br/>

        <input title="Forename" type="text" minlength='1' maxlength='50' name="Forename" required placeholder="Forename"><br/>
        <input title="Surname" type="text" minlength='1' maxlength='50' name="Surname" required placeholder="Surname"><br/><br/>
        
        <input title="Email" type="email" name="email" minlength='5' maxlength='50' placeholder="E-mail"><br/>
        <input title="Telephone number" minlength='11' maxlength='13' type="tel" name="telephoneNumber" placeholder="Phone number"><br/>
        <input title="Date of birth" type="date" name="dob"><br/><br/>

        <input type="submit" name="submit">
        
    </form> 
_END;

include_once 'partials/footer.php';

?>