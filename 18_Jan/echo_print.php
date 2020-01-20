<?php  

$name="divya";
$var1="name";

echo $var1."<br>";
echo $$var1;

$name='divya';
$var1='name';

echo '<br>'.$var1.'<br>';
echo $$var1."<br>";

echo 'hello! I am '.$name.'<br>';
echo 'hello! I am $name <br>';
echo "hello! I am $name <br>";

print("it is an example of print ".$$var1);

echo "<br><input type= 'text' name= 'field1'><br>";
echo '<br><input type= \'text\' name= \'field2\'><br>';
echo '<br><input type= "text" name= "field1"><br>';
?>