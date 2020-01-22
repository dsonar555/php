<?php 
    function isLeapYear( $year ) {
        if( ($year % 4) == 0 )
            return true;
        else
            return false; 
    }

    $year = 2020;
    if( isLeapYear($year) ) {
        echo "$year is a Leap Year.";
    } else {
        echo "$year is not a Leap Year.";
    }
?>