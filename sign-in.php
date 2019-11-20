<?php
    require_once 'partials/header.php'; //imports header & session
    $message="";

    if(isset($_SESSION['loggedIn']))
    {
        header("Location: view-surveys.php");//if user gets successfully authenticated then they get redirected
    }

    if(isset($_POST['submit']))
    {
        $usr= sanitise(validateString($_POST['username'], 2, 50));
        $pswd=sha1(sanitise(validateString($_POST['password'], 6,50)));

        require_once 'partials/dbconnection.php';//Opens a db connection

        if ($result=mysqli_query($con, "SELECT * FROM users WHERE usrname='$usr' AND pswd='$pswd'")) {
            // determine number of rows result set 
            $n = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            

            if ($n > 0)//If user exists then authenticate and assign session vars
            {
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $usr;

                if($row['privileges'] == 'admin')
                {
                    $_SESSION['admin'] = true;
                }
                else{
                    $_SESSION['admin'] = false;
                }

                header("Location: view-surveys.php");//redirects user to their survey portal
            }
            else
            {
                global $message;
                $message="<p class='error'>Sign in failed, please try again</p>";
            }
        }
        else{
            global $message;
            $message= "<p class='error'>Invalid SQL</p>"; 
        }
    }

    echo <<<_END
        <h2>Sign in</h2>
        <form action="sign-in.php" method="post">
            <p>Sign in to see your surveys</p>

            <input required minlength='2' maxlength='50' title="Username" type="text" name="username" placeholder="Username"><br/>
            <input required minlength='6' maxlength='50' title="Password" type="password" name="password" placeholder="Password"><br/>
            <input required type="submit" name="submit">
        </form>
_END;
    echo $message;

    require_once 'partials/footer.php';
?>