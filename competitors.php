<?php
    require_once 'partials/header.php';

    echo <<<_END
    <h2>Competitors</h2>

    <section>
        <details>
            <summary><h3>Survey Monkey</h3></summary>
            <p>To get started on survey monkey, you need to enter the following details</p>

            <ul>
                <li>Full name </li>
                <li>Username</li>
                <li>Valid email address</li>
                <li>Password</li>
            </ul>
        
            <p>However, you can sign up with other services such as Google, Microsoft, Twitter or Facebook which makes signing up take seconds and is easy to use however the icons for these services are smaller than I think is reasonable so don't make it too obvious that the option exists.</p>
        
            <p>Unique to survey monkey, they try and learn about who you are and what you anticipate to use the survey for. One sign of this is after you have created an account, they immediately prompt you to ‘Complete your profile’ which tried to gather information about you as a professional such as what sector do you work in and what role you have in the organisation. </p>

            <p>Personally, I feel that while this is an interesting feature, it doesn’t work very well and I find myself selecting a template from their design suggestions instead.</p>

            <p>One thing that does work well is the question bank feature that allows you to select commonly asked questions and use them within your answer. They also have a previously used questions feature which shows the questions you have made in your other surveys to allow easy recycling of common questions. Something that that aids the ease of use of the site.</p>

            <img src="Media/surveymonkey1.png" alt="Questions bank"/>

            <p>On the contrary, I dislike the look of the navigation panel to the right of the survey. When using it to build the survey, the question type options are duplicated and it isn't immediately obvious how to modify the appearance of the site. This makes it confusing and hard to navigate. In my opinion it is cluttered and the huge amounts of text make it overwhelming.</p>
        
            <p>In addition, the overall presentation of the surveys is good as it allows you to focus on the questions individually as they other questions are shown as out of focus when in one by one question mode. This is a feature that I like as it allows you to focus on the individual questions before advancing yourself to the next question and looks aesthetically pleasing at the same time. This can be seen below. As I suggested earlier, you can change the appearance of your survey also, you can pick between the themes suggested but if you want to customise fonts, colors and background, you have to upgrade to the premium platform.</p>
        
            <img src="Media/surveymonkey2.png" alt="Out of focus question">

            <p>Lastly, the results of the forms are shown in colour coded bar charts for the numerical data and in a long, scroll-able list for the text data. I feel this could be improved by making the list collapsible and having the option for different data presentation layouts</p>
        </details>
    </section>

    <section>
        <details>
            <summary><h3>Typeform</h3></summary>
        
            <p>What you need to get started on Typeform:</p>

            <ul>
                <li>Full name </li>
                <li>Valid email address (verification is required to gain access)</li>
                <li>Password</li>
            </ul>

            <br/>

            <img src="Media/typeform1.png" alt="login portal for typeform"/>

            <p>Typeform is another survey site but it's main focus is around minimalism and drawing data out of users in a logical, mapped out fashion. This is achieved by only having one question at a time displayed on screen, bold or italliciced individual words and the use of on-screen buttons and keyboard shortcuts that make navigating the site easy. To add to this, the icons and small views of the surveys you have already set up on your dashboard allow more insight and greater ease of use than a more text-based navigation environment. </p>
            
            
            
            <br/>

            <p>The idea of single questions per page and keyword highlighting is something that I would like to implement in to my project as I feel it dictates the flow through the website and allows a user to know what a question is asking at a glance. </p>

            <img src="Media/typeform2.png" alt="Dashboard for typeform"/>

            <p>While creating a survey, Typeform try to suggest relevant templates that you can use but this isn’t too invasive and by no means do you have to pick a layout style you like before creating the content of the form. Also while creating a survey, you have the option to create logical pathways and narrate the flow of the questions, rather than it being a linear process. This is based off the answers to previous questions. You can also recall answers to previous questions to make the tone of your survey more personalised.  </p>

            <p>While typeform’s ease of use is much greater than that of survey monkey, it does have it's trade off’s. One of which being half of the question types are able to be trialed as part of their ‘Pro’ platform. While this is good as it gives you access to view them and demo them, if you do use them within your form, it reders the form un-shareable unless you upgrade to the ‘Pro tier platform’. </p>

            <p>Similar to Google Forms, typeform does support exporting responses to google sheets and other services such as one drive as well. These responses are shown to the creator of the survey in the form of bar charts with percentage annotations and collapsable lists to allow a brief look at most recent responses. </p>

            <p>Uniquely though, typeform offers other metrics as well as just the responses from the questions. This includes things like time taken to complete the survey on average and how long ago it was since the last response. This is useful data for quantifiying user experience of the form in a functional way. </p>
        </details>
    </section>

    <section>
        <details>
            <summary><h3>Google forms</h3></summary>
        
        
        </details>
    </section>

    <section>
        <table>
            <tr>
                <th>Feature</th>
                <th>Survey monkey</th>
                <th>Typeform</th>
                <th>Google forms</th>
            </tr>
            <tr>
                <td>Multiple choice</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Short text</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Long text</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Checkboxes</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Dropdown</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>File upload</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Linear scale</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Multiple choice grid</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Time</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td></td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Statement</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
            </tr>
            <tr>
                <td>Picture choice</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
            </tr>
            <tr>
                <td>Email</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
            </tr>
            <tr>
                <td>Number</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
            </tr>
            <tr>
                <td>Website</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
            </tr>
            <tr>
                <td>Payment</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
            </tr>
        </table>
    </section>



_END;
    require_once 'partials/footer.php';
?>
