<?php

include_once 'partials/header.php';

if(isset($_POST['update'])){
    require_once 'partials/dbconnection.php';

    if(mysqli_query($con,"UPDATE users SET privileges='$_POST[roles]'WHERE usrname='$_POST[username]'")){}
    {
        echo "<p>Updated!</p>";
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
        </td></tr>";
    }
    else
    {
        echo"<select name='roles'>
        <option value='user' selected>$row[privileges]</option>
        <option value='admin'>admin</option>
        </select>
        </td></tr>";
    }

}

echo<<<_END
        
    </table>
    <input type="submit" name="update" value="Update"/>
    </form>
_END;

include_once 'partials/footer.php';

?>