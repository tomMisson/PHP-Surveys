<?php

require_once 'partials/builder-viewer-header.php';

    if(isset($_SESSION['surveyID']))
    {
        if(isset($_SESSION['owner']))
        {
            if($_SESSION['owner'])
            {
                echo "
                    <section>
                        <details>
                            <summary>Table</summary>";

                            $result = mysqli_query($con, "")

                            while(($row = mysqli_fetch_assoc($result) != null))
                            {
                                echo "
                                <table>
                                    <th>
                                        <td>NAME</td>
                                    </th>";
                                
                                //Itterate through responses
                                //SELECT title, answer FROM `answers` INNER JOIN questions USING (id) WHERE questions.id=3
                                echo "</table>";
                            }

                        echo"</details>
                    </section>";
            }
            else
            {
                header('Location: view-surveys.php');
            }
        }
        else
        {
            header('Location: admin.php');
        }
    }
    else
    {
        header('Location: view-surveys.php');
    }

?>