<?php

include_once 'partials/header.php';

echo <<<_END 
<main> 
    <h1>Sign up</h1>
    <form method="post">
        <input type="text" name="Forename" placeholder="Forename">
        <input type="text" name="Surname" placeholder="Surname">
        <input type="text" name="UID" placeholder="Username">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="pswd" placeholder="Password" >
        <input type="password" name="pswdConf" placeholder="Confirm password">
    </form> 
</main>
            
_END

include_once 'partials/footer.php';

?>