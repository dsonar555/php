<?php
// declare(strict_types = 1);
// function addNum($n1,$n2)
// {
// 	return $n1+$n2;
// }
// function divide($n1,$n2)
// {
// 	return $n1/$n2;
// }

// $result=divide(addNum(25,25),addNum(3,2));
// echo 'Result 1 : '.$result.'<br>';

// $result=addNum(divide(10,5),divide(10,2));
// echo 'Result 2 : '.$result.'<br>';

/* function &retrunsReference()
{
	$val="CyberCom";
	return $val;
}

$newvalue =& retrunsReference();
var_dump( $newvalue );
 */

/* function add($number1, $number2):float {
 	return "$number1"." "."$number2";
}

echo add("5","10");
 */

/* function name($name)
{
	return $name;
}
function callAnother($name)
{
	return $name;
}
function printName()
{
	echo "In PrintName()";
}

name("callAnother")("printName")(); */

class Demo {
    public $variable= 45;
    function &getValue() {
        return $this->variable;
    }
}
$obj=new Demo();
echo "Before function call : ".$obj->getValue();
$obj->variable=10;
echo "After function call : ".$obj->getValue();


?>