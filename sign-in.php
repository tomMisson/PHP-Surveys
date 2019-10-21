<?php
    require_once 'partials/header.php'; //imports header & session
    $message="";

    if(isset($_SESSION['loggedIn']))
    {
        header("Location: view-surveys.php");//if user gets successfully authenticated then they get redirected
    }

    if(isset($_POST['submit']))
    {
        $usr=$_POST['username'];
        $pswd=$_POST['password'];

        require_once 'partials/dbconnection.php';//Opens a db connection

        if ($result=mysqli_query($con, "SELECT * FROM users WHERE usrname='$usr' AND pswd='$pswd'")) {
            // determine number of rows result set 
            $n = mysqli_num_rows($result);

            

            if ($n > 0)//If user exists then authenticate and assign session vars
            {
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $usr;

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

            <input type="text" name="username" placeholder="Username"><br/>
            <input type="password" name="password" placeholder="Password"><br/>
            <input type="submit" name="submit">
        </form>
_END;
    echo $message;

    require_once 'partials/footer.php';
?>