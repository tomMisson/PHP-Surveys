<?php
    require_once 'partials/header.php'; 

    if(isset($_SESSION['loggedIn']))
    {
        echo "<h2>Your account</h2>";

        require_once 'partials/dbconnection.php';//Opens a db connection

        if ($result=mysqli_query($con, "SELECT * FROM users WHERE usrname='".$_SESSION['username']."'")){
            // determine number of rows result set 
                
            $row = mysqli_fetch_assoc($result);
        }
        if(isset($_POST['submit']))
        {
            $pswd = sha1(sanitise(validateString($_POST['pswd'], 6,50)));
            $forename = sanitise(validateString($_POST['firstname'], 1, 50));
            $surname = sanitise(validateString($_POST['lastname'], 1, 50));
            $email = sanitise(validateString(validateEmail($_POST['Email']),5,50));
            $tel = sanitise(validateString($_POST['telephoneNumber'], 10, 15));
            $dob = sanitise(validateDate($_POST['dob']));

            include_once 'partials/dbconnection.php';

            mysqli_query($con,"UPDATE users SET pswd='$pswd', firstname='$forename', lastname='$surname', email='$email', dob='$dob',telephoneNumber='$tel' WHERE usrname='".$_SESSION['username']."'");
            header("Location: view-account.php");
        
        }
        if(isset($_POST['editBtn']))
        {
            echo <<<_END
                <article>
                    <form action='view-account.php' method='post'>
                        <label for='username'>Username:</label>
                        <input readonly type='text' name='username' placeholder='$row[usrname]'><br/>
                        
                        <label for='pswd'>Password:</label>
                        <input required minlength='6' maxlength='50' title='Password' type='password' name='pswd' value=''><br/>

                        <label for='firstname'>Forename:</label>
                        <input required minlength='1' maxlength='50' title='Firstname' type='text' name='firstname' value='$row[firstname]'><br/>

                        <label for='lastname'>Surname:</label>
                        <input required minlength='1' maxlength='50' title='Surname' type='text' name='lastname' value='$row[lastname]'><br/>

                        <label for='email'>Email:</label>
                        <input required minlength='5' maxlength='50' title='email' type='text' name='Email' value='$row[email]'><br/>

                        <label for='telephoneNumber'>Phone number:</label>
                        <input required title="Telephone number" minlength='11' maxlength='13' type='text' name='telephoneNumber' value='$row[telephoneNumber]'> <br/>

                        <label for='dob'>Date of birth:</label>
                        <input required type='date' name='dob' value='$row[dob]'><br/>

                    </article>
                <input type='submit' name='submit'>
            </form>
_END;
            
        }
        else
        {
            echo <<<_END
            <article>
                <form action="view-account.php" method="post">
                    <label for="username">Username:</label>

            
                    <input readonly type='text' name='username' placeholder='$row[usrname]'><br/>
            
                    <label for='pswd'>Password:</label>
                    <input readonly type='password' name='pswd' placeholder='To change, click edit'><br/>


                    <label for='firstname'>Forename:</label>
                    <input readonly type='text' name='firstname' placeholder='$row[firstname]'><br/>

                    <label for='lastname'>Surname:</label>
                    <input readonly type='text' name='lastname' placeholder='$row[lastname]'><br/>
                
                    <label for='email'>Email:</label>
                    <input readonly type='text' name='Email' placeholder='$row[email]'><br/>

                    <label for='telephoneNumber'>Phone number:</label>
                    <input readonly type='text' name='telephoneNumber' placeholder='$row[telephoneNumber]'><br/>

                    <label for='dob'>Date of birth:</label>
                    <input readonly type='text' name='dob' placeholder='$row[dob]'><br/>

                    </article>
                    <input type='submit' name='editBtn' value='Edit'>
                </form>
_END;
        }
    }
    else{
        header("Location: sign-in.php");
    }

    require_once 'partials/footer.php';
?>