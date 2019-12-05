<?php
    require_once 'partials/builder-viewer-header.php';

    if(isset($_SESSION['surveyID']))
    {
        echo<<<_END
            <section>
                <h2>Response logged!</h2>
                <p>Thank you for your response. Your answer is now visible to the owner of this survey.</p>
                <a class='link' href='view-survey.php?id=$_SESSION[surveyID]'>Click here to log another response</a>
            </section>
_END;
    }
    else{
        echo<<<_END
            <section class='center'>
                <h2 class='error'>Error</h2>
                <p>No response found, </p>
                <a class='link' href='view-surveys.php'>click here to return to surveys</a>
            </section>
_END;
    }
?>