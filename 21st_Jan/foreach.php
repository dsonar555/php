<?php
/* 
$India = array(
        'Maharashtra' => array('Mumbai', 'Pune', 'Nasik', 'Nagpur'),
        
        'Gujrat' => array('Ahmedabad', 'Surat', 'Rajkot'),
        
		'Rajasthan' => array('Jaipur', 'Jodhpur')
	);

foreach($India as $state =>  $cities_array)
{
	echo '<strong>'.$state.'</strong><br>';
	foreach($cities_array as $city)
	{
		echo '<li>'.$city.'</li>';
	}
	echo '<br>';
} */

/* $food = [ 'Pasta' => 400,'Noddles' => 500, 'Pizza' => 1000, 'Vegetables' => 300, 'Salad' => 400 ];

foreach ( $food as $dishes => $calories ) {
    echo '<li>'.$dishes.' : '.$calories.'</li>';
} */

 $numbers = [3, 4, 5, 6, 2, 7];
echo "numbers before squaring : ";
print_r($numbers);
foreach( $numbers as &$singleNumber ) {
    $singleNumber *= $singleNumber;
}
echo "<br> Numbers after squaring : ";
print_r($numbers); 

// $array = [
//     [1, 2],
//     [3, 4],
//     [5, 6]
// ];

// foreach ($array as list($a, $b) ) {
//     echo "{$a}, {$b} <br>";
// }


?>