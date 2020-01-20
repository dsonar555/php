<?php

$string = 'We live in India & in Asia.';
$totalWords = str_word_count( $string );//str_word_count($string,0); both are similar
echo $totalWords.'<br>';

$arrayofWords = str_word_count( $string, 1 );
print_r($arrayofWords);
echo '<br>';

$arrayofWordsWithPosition = str_word_count($string,2);
print_r( $arrayofWordsWithPosition );
echo'<br>';

$arrayofWordsWithAdditionalWord = str_word_count($string,1,'&.');//it will include . and & in the string
print_r( $arrayofWordsWithAdditionalWord );

?>