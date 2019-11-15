<?php

function sanitise($str)
{
	if (get_magic_quotes_gpc())
	{
		$str = stripslashes($str);
    }
    $con = mysqli_connect("localhost", "root", "", "questionsanswered");
	$str = mysqli_real_escape_string($con, $str);
	$str = htmlentities($str);
	return $str;
}

function validateString($field, $minlength, $maxlength) 
{
    if (strlen($field)<$minlength) 
    {
        return "Minimum length: " . $minlength; 
    }

	elseif (strlen($field)>$maxlength) 
    { 
        return $field; 
    }

    return $field; 
}

function validateInt($field, $min, $max) 
{ 
	$options = array("options" => array("min_range"=>$min,"max_range"=>$max));
    
	if (!filter_var($field, FILTER_VALIDATE_INT, $options)) 
    { 
        return "Not a valid number (must be whole and in the range: " . $min . " to " . $max . ")"; 
    }
    return $field; 
}

function validateEmail($field)
{
    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) 
    {
        return "Invalid email address";
    } 
    return $field;
}

function validateDate($field)
{
    if($field > date("Y-m-d") ) {
        return "Invalid date";
    }
    return $field;
}

?>