<?php
    function reverseNumber($number) {
        $reverse = 0;
        while( $number > 0) {
            $mod = $number % 10;
            $reverse *=10;
            $reverse += $mod;
            $number = intval($number / 10);
        }
        return $reverse;
    }

    $number = 487056;
    echo "the reverse number of $number is : ".reverseNumber($number);

    
?>