<?php

    require_once 'partials/dbconnection.php';

    if(isset($_POST['submit']))
    {
        $usr=$_POST['username'];
        $password=$_POST['password'];

        $result=query("SELECT * FROM members WHERE usr='$usr' AND pswd='$password'");

        echo " result=". $result;
        $n = mysqli_num_rows($result);

        if ($n > 0)
        {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;

            
        }
        else
        {
            $message = "<p>Sign in failed, please try again</p>";
        }

    }
    else{
       
    }

    require_once 'partials/header.php';

    echo <<<_END
        <h2>Sign in</h2>
        <form action="sign-in.php" method="post">
            <p>Sign in to see your surveys</p>

            <input type="text" name="username" placeholder="Username"><br/>
            <input type="password" name="password" placeholder="Password"><br/>
            <input type="submit" name="submit">
        </form>
_END;

    require_once 'partials/footer.php';

?>