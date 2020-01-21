<?php

$India=array(
		'Maharashtra'=>array('Mumbai','Pune','Nasik','Nagpur'),
		'Gujrat'=>array('Ahmedabad','Surat','Rajkot'),
		'Rajasthan'=>array('Jaipur','Jodhpur')
	);

echo $India['Maharashtra'][0].',&nbsp';
echo $India['Maharashtra'][2].'<br>';
echo $India['Gujrat'][1].',&nbsp';
echo $India['Gujrat'][2].'<br>';
echo $India['Rajasthan'][0].'<br>';

print_r($India);

?>