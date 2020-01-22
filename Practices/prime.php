<?php

function isPrime($number) {
    if( ($number % 2) == 0 ) {
        return false;
    } else {
        for($i=3; $i<=($number/2); $i+=2) {
            if( ($number % $i) == 0 ) {
                return false;
            } 
        }
        return true;
    }
}

$number = 49;
if( isPrime($number) ) {
    echo "$number is Prime.";
} else {
    echo "$number is not prime.";
}


?>