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

function validateURL($field)
{
    if (!filter_var($field, FILTER_VALIDATE_URL)) {
        return "Invaild url";
    } 
    return $field;
}

function validateTel($field)
{
    if($field = filter_var($number, FILTER_SANITIZE_NUMBER_INT))
    {
        $field = validateString($field.'', 5, 15);
        return $field;
    }
    else{
        return "Invalid";
    }
}

function validateCol($field)
{
    if(!preg_match($field, "/#([a-f0-9]{3}){1,2}\b/i"))
    {
        return "Invalid colour";
    }
    return $field;
}

?>