<?php

$string1 = 'We are indians. We live in India.';
$string2 = 'We live in India. We are known as Indians.';

similar_text( $string1, $string2, $similarity);
echo 'The Similarity is : '.$similarity;

echo '<br>';
$string2 = 'We are known as Indians. We live in India.';
similar_text( $string1, $string2, $similarity );
echo 'The Similarity is : '.$similarity;

$str_length=strlen( $string1 );
echo '<br>The length of string1 is : '.$str_length;

?>