<?php 

$var1="hello! good morning";
$var2="good noon";
$var3="good evening";
?>

<input type="text" value="<?php echo $var1; ?>"><br><br>

Select anyone:
<select >
	<option value="morning" ><?php echo $var1; ?></option>
	<option value="noon" selected><?php echo $var2; ?></option>
	<option value="evening"><?php echo $var3; ?></option>
</select>
