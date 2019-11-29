<?php
require_once 'partials/builder-viewer-header.php';

if(isset($_SESSION['surveyID']))
{
    echo<<<_END
    <section>
        <form method="POST">
            <select id="question-types">
                <option value='text'>Text</option>
                <option value='number'>Number</option>
                <option value='date'>Date</option>
                <option value='email'>Email</option>
                <option value='url'>Website</option>
                <option value='tel'>Phone number</option>
                <option value='color'>Colour</option>
            </select>
            
            <input name="Submit" type=submit>
        </form>
    </section>

    <script>
        $()
    </script>
_END;
}
else if(isset($_POST['Submit']))
{

}
else
{
    header('Location: index.php');
}


?>