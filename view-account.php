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
            $pswd = sha1($_POST['pswd']);
            $forename = $_POST['firstname'];
            $surname = $_POST['lastname'];
            $email = $_POST['Email'];
            $tel = $_POST['telephoneNumber'];
            $dob = $_POST['dob'];

            include_once 'partials/dbconnection.php';

            mysqli_query($con,"UPDATE users SET pswd='$pswd', firstname='$forename', lastname='$surname', email='$email', dob='$dob',telephoneNumber='$tel' WHERE usrname='".$_SESSION['username']."'");

            echo "<h3>Updated!</h3>";
            header("Location: view-account.php");
        }
        if(isset($_POST['editBtn']))
        {
            echo <<<_END
                <article>
                    <form action="view-account.php" method="post">
                        <label for="username">Username:</label>
_END;
                        echo "<input readonly type='text' name='username' placeholder='".$row['usrname']."'><br/>";
                        
                        echo "<label for='pswd'>Password:</label>";
                        echo "<input type='password' name='pswd' placeholder=''><br/>";

                        echo "<label for='firstname'>Forename:</label>";
                        echo "<input type='text' name='firstname' value='".$row['firstname']."'><br/>";

                        echo "<label for='lastname'>Surname:</label>";
                        echo "<input type='text' name='lastname' value='".$row['lastname']."'><br/>";

                        echo "<label for='email'>Email:</label>";
                        echo "<input type='text' name='Email' value='".$row['email']."'><br/>";

                        echo "<label for='telephoneNumber'>Phone number:</label>";
                        echo "<input type='text' name='telephoneNumber' value='".$row['telephoneNumber']."'><br/>";

                        echo "<label for='dob'>Date of birth:</label>";
                        echo "<input type='date' name='dob' value='".$row['dob']."'><br/>";

                    echo"</article>";
                echo "<input type='submit' name='editBtn' value='Edit'>";
                echo "<input type='submit' name='submit'>";
            echo"</form>";

            
        }
        else
        {
            echo <<<_END
            <article>
                <form action="view-account.php" method="post">
                    <label for="username">Username:</label>
_END;
            
                    echo "<input readonly type='text' name='username' placeholder='".$row['usrname']."'><br/>";
            
                    echo "<label for='pswd'>Password:</label>";
                    echo "<input type='password' name='pswd' placeholder='To change, click edit'><br/>";


                    echo "<label for='firstname'>Forename:</label>";
                    echo "<input readonly type='text' name='firstname' placeholder='".$row['firstname']."'><br/>";

                    echo "<label for='lastname'>Surname:</label>";
                    echo "<input readonly type='text' name='lastname' placeholder='".$row['lastname']."'><br/>";
                
                    echo "<label for='email'>Email:</label>";
                    echo "<input readonly type='text' name='Email' placeholder='".$row['email']."'><br/>";

                    echo "<label for='telephoneNumber'>Phone number:</label>";
                    echo "<input readonly type='text' name='telephoneNumber' placeholder='".$row['telephoneNumber']."'><br/>";

                    echo "<label for='dob'>Date of birth:</label>";
                    echo "<input readonly type='text' name='dob' placeholder='".$row['dob']."'><br/>";

                    echo"</article>";
                    echo "<input type='submit' name='editBtn' value='Edit'>";
                echo"</form>";
            
        }
    }
    else{
        header("Location: sign-in.php");
    }

    require_once 'partials/footer.php';
?>