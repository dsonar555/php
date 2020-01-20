<?php 

$number=6;

switch($number)
{
	case 1:
		echo 'One';
	break;

	case 2:
		echo 'Two';
	break;

	case 3:
		echo 'Three';
	break;

	default:
		echo 'any number grater than 3';
}

echo '<br>';
$var='MUM';

switch($var)
{
	case 'AMD':
		echo 'Ahmedabad';
	break;

	case 'MUM':
		echo 'Mumbai';
	break;

	case 'HYD':
		echo 'Hydrabad';
	break;

	case 'CHN':
		echo 'Chennai';
	break;
}

?>