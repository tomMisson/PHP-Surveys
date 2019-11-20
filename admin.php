<?php

include_once 'partials/header.php';

if(isset($_SESSION['loggedIn']))
{
    if(isset($_POST['update'])){
        require_once 'partials/dbconnection.php';

        if(isset($_POST['roles']))
        {
            if(isset($_POST['usrToDel']))
            {
                if(mysqli_query($con, "DELETE FROM users WHERE usrname='$_POST[usrToDel]';"))
                {
                    echo "<p class='error'>Deleted $_POST[usrToDel]!</p>";
                }
            }
            if(mysqli_query($con,"UPDATE users SET privileges='$_POST[roles]'WHERE usrname='$_POST[username]';")){}
            {
                echo "<p class='error'>Updated!</p>";
            }
        }
        
    }

    if(isset($_POST['updateSurveys'])){

        if(isset($_POST['surveyToDel']))
        {
            if(mysqli_query($con, "DELETE FROM surveys WHERE id='$_POST[surveyToDel]';"))
            {
                echo "<p class='error'>Deleted survey!</p>";
            }
        }  
    }

    echo<<<_END

        <h2>Admin tools</h2>
        <h3>Users</h3>
        <form method='post'>
        <table>
        <tr>
            <th>Username</th>
            <th>Firstname</th>
            <th>Surname</th>
            <th>Role</th>
            <th>Delete</th>
        </tr>
_END;

    require_once 'partials/dbconnection.php';

    $users = mysqli_query($con, "SELECT usrname, firstname, lastname, privileges FROM users WHERE usrname != '$_SESSION[username]'");

    while($row = mysqli_fetch_assoc($users)) {
        echo "<tr><td><input readonly type='text' name='username' value='$row[usrname]'></td><td>$row[firstname]</td><td>$row[lastname]</td><td>";

        if($row['privileges']=="admin")
        {
            echo"<select name='roles'>
            <option value='admin' selected>$row[privileges]</option>
            <option value='user'>user</option>
            </select>
            </td>
            <td><input type='radio' name='usrToDel' value=$row[usrname]/></td>
            </tr>";
        }
        else
        {
            echo"<select name='roles'>
            <option value='user' selected>$row[privileges]</option>
            <option value='admin'>admin</option>
            </select>
            </td>
            <td><input type='radio' name='usrToDel' value=$row[usrname]></td>
            </tr>";
        }

    }

    echo<<<_END
            
        </table>
        <input type="submit" name="update" value="Update"/>
        </form>

        <br><br>
        <h3>Surveys</h3>
        <p>To edit any survey, click on the survey name.</p>
        <form method='post'>
        <table>
        <tr>
            <th>Survey Name</th>
            <th>Owner</th>
            <th>Delete</th>
        </tr>
_END;
        $users = mysqli_query($con, "SELECT * FROM surveys ORDER BY username");

        while($row = mysqli_fetch_assoc($users)) {
            echo<<<_END
            <tr>
            <td><a href="view-survey.php?id=$row[id]"><input readonly type='text' name='surveyName' class= 'trasparent' value='$row[surveyName]'></a></td>
            <td>$row[username]</td>
            <td><input type='radio' name='surveyToDel' value='$row[id]'></td>
            </tr>
_END;
        }
        echo "</table><input type='submit' name='updateSurveys' value='Update'></form>";

}
else{
    echo "<p class='error'>You need to be signed in to view this page <a href='sign-in.php'>click here to sign in</a></p>";
}

include_once 'partials/footer.php';

?>