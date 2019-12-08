<?php
    require_once 'partials/builder-viewer-header.php';
    if(isset($_POST['CSV']))
    {
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

        $fh = fopen("data.csv", "w");

        fputcsv($fh, $headers);
        fputcsv($fh, $data);

        fclose($fh);
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="data.csv";');

    }
    else if(isset($_SESSION['surveyID']))
    {
        if(isset($_SESSION['owner']))
        {
            if($_SESSION['owner'])
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

                    echo"
                        </table>
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
                        $result = mysqli_query($con, "SELECT title, COUNT(answer) as numberResponses FROM questions INNER JOIN answers ON answers.question = questions.id WHERE questions.survey = $_SESSION[surveyID] GROUP BY title");
                        
                        for($k=0; $k<mysqli_num_rows($result); $k++)
                        {
                            $row = mysqli_fetch_assoc($result);
                            $str = "['$row[title]', ". $row['numberResponses']. '],';
                            echo $str;
                        }
                        
                        
                        echo<<<_END
                        ]);
                
                        // Set chart options
                        var options = {'title':'Favorites responses',
                                        'width':400,
                                        'height':300};
                
                        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                        }
                    </script>
                    <div id="chart_div"></div>
                </section>
_END;
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