<?php

function validateEmail($string) {
    if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $string) )
        return true;
    else 
        return false;
}

$email = "dsonar555@gmail.com";
if( validateEmail($email) ) {
    echo "Yes! it is correct email format.";
} else {
    echo "It is not correct email id...Reenter it.";
}

?>