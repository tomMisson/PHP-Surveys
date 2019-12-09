<?php
    require_once 'partials/builder-viewer-header.php';
    if(isset($_POST['CSV']))
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="data.csv";');

        $resultTitles = mysqli_query($con, "SELECT DISTINCT title FROM questions INNER JOIN answers ON answers.question = questions.id WHERE questions.survey = $_SESSION[surveyID]");
        $resultData = mysqli_query($con, "SELECT answer FROM answers INNER JOIN questions ON answers.question = questions.id WHERE questions.survey = $_SESSION[surveyID]");

        $data = array();
        $headers = array();
        for($i =0; $i<mysqli_num_rows($resultTitles); $i++)
        {
            $row = mysqli_fetch_assoc($resultTitles);
            array_push($headers, $row['title']);
        }
        for($i=0; $i<mysqli_num_rows($resultData); $i++)
        {
            $row = mysqli_fetch_assoc($resultData);
            array_push($data, $row['answer']);
        }

        $fh = fopen("php://output", "w");

        fputcsv($fh, $headers);
        fputcsv($fh, $data);

        fclose($fh);

    }
    else if(isset($_SESSION['surveyID']))
    {
        if(isset($_SESSION['owner']))
        {
            if($_SESSION['owner'])
            {
                $numofResponses = mysqli_query($con, "SELECT count(answer) AS numberOfResponses FROM `answers` INNER JOIN questions on answers.question=questions.id INNER JOIN surveys on questions.survey=surveys.id WHERE surveys.id=$_SESSION[surveyID]");
                $answersrow = mysqli_fetch_assoc($numofResponses);
                if($answersrow['numberOfResponses']>0)
                {                
                    echo "
                    <section>
                        <h2>Responses</h2>
                            <table>
                            <tr>";

                            $resultTitles = mysqli_query($con, "SELECT DISTINCT title FROM questions INNER JOIN answers ON answers.question = questions.id WHERE questions.survey = $_SESSION[surveyID]");

                            for($i =0; $i<mysqli_num_rows($resultTitles); $i++)
                            {
                                $row = mysqli_fetch_assoc($resultTitles);
                                echo"<th>$row[title]</th>";
                            }
                            echo "</tr><tr>";

                            $resultData = mysqli_query($con, "SELECT answer FROM answers INNER JOIN questions ON answers.question = questions.id WHERE questions.survey = $_SESSION[surveyID]");

                            for($i=0; $i<mysqli_num_rows($resultData); $i++)
                            {
                                $row = mysqli_fetch_assoc($resultData);
                                
                                if($i % (mysqli_num_rows($resultTitles))==0 && $i>0)
                                {
                                    echo "</tr><tr>";
                                    echo"<td>$row[answer]</td>";
                                }
                                else{
                                    echo"<td>$row[answer]</td>";
                                }
                            }
                            echo "</tr>";

                            $noOfRespondants = ($answersrow['numberOfResponses']/mysqli_num_rows($resultTitles));

                        echo"
                            </table>
                            <p>No. of respondants: $noOfRespondants</p>
                            <form method='post'>
                                <input type='Submit' name='CSV' value='Export CSV'>
                            </form>
                    </section>";

                    echo<<<_END
                    <section>
                        <h2>Graphs</h2>
                        <script type="text/javascript">
                            // Load the Visualization API and the corechart package.
                            google.charts.load('current', {'packages':['corechart']});
                    
                            // Set a callback to run when the Google Visualization API is loaded.
                            google.charts.setOnLoadCallback(drawChart);
                    
                            // Callback that creates and populates a data table,
                            // instantiates the pie chart, passes in the data and
                            // draws it.
                            function drawChart() {
                    
                            // Create the data table.
                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'Questions');
                            data.addColumn('number', 'No. of people responded');
                            data.addRows([
_END;
                            $result = mysqli_query($con, "SELECT title, COUNT(answer) as numberResponses FROM questions INNER JOIN answers ON answers.question = questions.id WHERE questions.survey = $_SESSION[surveyID] and answers.answer != ' ' GROUP BY title");
                            
                            for($k=0; $k<mysqli_num_rows($result); $k++)
                            {
                                $row = mysqli_fetch_assoc($result);
                                $str = "['$row[title]', ". $row['numberResponses']. '],';
                                echo $str;
                            }
                            
                            $result = mysqli_query($con, "SELECT surveyName FROM surveys WHERE id='$_SESSION[surveyID]'");
                            $row = mysqli_fetch_assoc($result);
                            $title = $row['surveyName'];
                            echo"
                            ]);
                    
                            // Set chart options
                            var options = {'title':'".$title."',
                                            'width':400,
                                            'height':300,
                                            is3D: true};
                    
                            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                            chart.draw(data, options);
                            }
                        </script>
                        <div id='chart_div'></div>
                    </section>";
                }
                else
                {
                    echo "<section><h2>No one has got back to you 😢</h2><br/><p>You may want to consider sharing the survey if it isn't already</p></section>";
                }
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