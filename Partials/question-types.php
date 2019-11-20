<?php

function multipulChoice($title, $option1, $option2, $option3, $required)
{
    return <<<_END
    <article>
        <h4>$title</h4>
        <form action='post'>

        </form>
    </article>
_END;

}

function longText($title, $required)
{
    return <<<_END
    <article>
        <h4>$title</h4>
        <form action='post'>
            <textarea ></textarea>  
        </form>
    </article>
_END;

}



?>