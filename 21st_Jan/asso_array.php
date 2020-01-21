<?php

/* $cities=array('AMD'=>'Ahmedabad', 'MUM'=>'Mumbai', 'DEL'=>'Delhi');
echo $cities['AMD'].', &nbsp';
echo $cities['MUM'].', &nbsp';
echo $cities['DEL'].'&nbsp';
$cities['NAS']='Nasik';
echo'<br>';
print_r($cities);

echo "<br>The full form of NAS is : {$cities['NAS']}";
// echo "<br>The full form of NAS is : $cities['NAS']";
 */

/* $array=array('1'=>'one','Two','3'=>'three');
$index='0';
$length=count($array);
while($index <= $length)
{
    echo $array[$index]."<br>";
    $index++;
}
 */
function set_element(&$path, $data) {
    return ($key = array_pop($path)) ? set_element($path, array($key=>$data)) : $data;
}

echo "<pre>";
$path = array('base', 'category', 'subcategory', 'item');
$array = set_element($path, 'item_value');
print_r($array);
echo "</pre>";



?>