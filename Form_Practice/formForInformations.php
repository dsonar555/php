<?php
session_start();
if(isset($_POST['Submit'])) { 
	require_once 'getInformation.php';
	setData();
} else if(isset($_SESSION['data'])) {
	//require_once 'getInformation.php';
	$data = $_SESSION['data'];
	print_r($data);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			div{
				/*text-align: center;*/
			}
		</style>
	</head>
    <body>
    	<hr>
    	<div>
	        <input type="checkbox" name="otherInformation" onclick="displayOtherInformation()">Other Information<br><br>
	        <form action="formForInformations.php" method="POST" enctype="multipart/form-data">
	            <fieldset>
	                <legend>Your Account Details</legend>
	                <select name="prefix">
	                    <option value="Mr"
						<?php if($data['prefix'] == 'Mr') echo 'Selected'; ?> >Mr</option>
	                    <option value="Mrs" 
						<?php if($data['prefix'] == 'Mrs') echo 'Selected'; ?>>Mrs</option>
	                    <option value="Ms" 
						<?php if($data['prefix'] == 'Ms') echo 'Selected'; ?>>Ms</option>
	                    <option value="Dr" 
						<?php if($data['prefix'] == 'Dr') echo 'Selected'; ?>>Dr</option>
	                </select><br><br>
	                First Name: &nbsp&nbsp*<br><input type="text" name="firstName" value="<?= $data['firstName'] ?>"><br><br>
	                Last Name: &nbsp&nbsp*<br><input type="text" name="lastName" value="<?= $data['lastName '] ?>"><br><br>
	                Birth Date: <br><input type="date" name="birthDate" value="<?= $data['birthDate'] ?>"><br><br>
	                Mobile No.: &nbsp&nbsp*<br><input type="text" name="phoneNo" value="<?= $data['mobileNo'] ?>"><br><br>
	                Email: &nbsp&nbsp*<br><input type="text" name="email" value="<?= $data['email'] ?>"><br><br> 
	                Password: &nbsp&nbsp*<br><input type="password" name="password" value="<?= $data['password'] ?>"><br><br>
	                Confirm Password: &nbsp&nbsp*<br><input type="password" name="confirmPassword" value="<?= $data['password'] ?>"><br><br>        
	            </fieldset>
	            <fieldset>
	                <legend>Address Information</legend>
	                Address line 1: &nbsp&nbsp*<br><input type="text" name="addressLine1" value="<?= $data['addressLine1'] ?>"><br><br>
	                Address line 2: &nbsp&nbsp*<br><input type="text" name="addressLine2" value="<?= $data['addressLine2'] ?>"><br><br>
	                Company: <br><input type="text" name="company" value="<?= $data['company'] ?>"><br><br>
	                City: &nbsp&nbsp*<br><input type="text" name="city" value="<?= $data['city'] ?>"><br><br>
	                State: &nbsp&nbsp*<br><input type="text" name="state" value="<?= $data['state'] ?>"><br><br>
	                Country : &nbsp&nbsp*<br><select name="country">
	                	<option hidden>select country</option>
						<option value="India" 
						<?php if($data['country'] == 'India') echo 'Selected'; ?>>India</option>
						<option value="Nepal"
						<?php if($data['country'] == 'Nepal') echo 'Selected'; ?>>Nepal</option>
						<option value="China"
						<?php if($data['country'] == 'China') echo 'Selected'; ?>>China</option>
						<option value="Bhutan"
						<?php if($data['country'] == 'Bhutan') echo 'Selected'; ?>>Bhutan</option>
	                </select><br><br>
	                Postal Code: &nbsp&nbsp*<br><input type="text" name="postalCode" value="<?= $data['postalCode'] ?>"><br><br>
	            </fieldset>
	            
	            <fieldset id="otherInformation">
	                <legend>Other Information</legend>
	                Describe Yourself: &nbsp&nbsp*<br><textarea rows="5" column="30" name="aboutYourself"><?= $data['aboutYourself'] ?></textarea><br><br>
	                Profile Image: <br><input type="file" name="profileImage" value="<?= $data['profileImage'] ?>"><br><br>
	                Certificate: <br><input type="file" name="certificate" value="<?= $data['certificate'] ?>"><br><br>
	                How long have you been in business?<br>
					<input type="radio" name="businessYears" value="under1year"
					<?php if($data['businessYears'] == 'under1year') echo 'checked'; ?>>&nbsp Under 1 Year<br>
					<input type="radio" name="businessYears" value="1_2_Years" 
					<?php if($data['businessYears'] == '1_2_Years') echo 'checked'; ?>>&nbsp 1-2 Years<br>
					<input type="radio" name="businessYears" value="2_5_Years"
					<?php if($data['businessYears'] == '2_5_Years') echo 'checked'; ?>>&nbsp 2-5 Years<br>
					<input type="radio" name="businessYears" value="5_10_Years"
					<?php if($data['businessYears'] == '5_10_Years') echo 'checked'; ?>>&nbsp 5-10 Years<br>
					<input type="radio" name="businessYears" value="over10years"
					<?php if($data['businessYears'] == 'over10Years') echo 'checked'; ?>>&nbsp Over 10 Years<br><br>
	                Number of clients you see each week?<br>
	                <select name="numberOfClients">
	                	<option value="1_5" <?php if($data['numberOfClients'] == '1_5') echo 'Selected'; ?>>1-5</option>
	                	<option value="6_10" <?php if($data['numberOfClients'] == '6_10') echo 'Selected'; ?> >6-10</option>
	                	<option value="11_15" <?php if($data['numberOfClients'] == '11_15') echo 'Selected'; ?> >11-15</option>
	                	<option value="15+" <?php if($data['numberOfClients'] == '15+') echo 'Selected'; ?> >15+</option>
	                </select><br><br>
	                How do you like us to get in touch with you? &nbsp&nbsp*<br>
	                <input type="checkbox" name="contactMedium[]" value="Post" <?php if(in_array("Post",$data['contactMedium'])) echo 'Checked';?> >&nbsp Post<br>
	                <input type="checkbox" name="contactMedium[]" value="Email" <?php if(in_array("Email",$data['contactMedium'])) echo 'Checked';?> >&nbsp Email<br>
	                <input type="checkbox" name="contactMedium[]" value="SMS" <?php if(in_array("SMS",$data['contactMedium'])) echo 'Checked';?>>&nbsp SMS<br>
	                <input type="checkbox" name="contactMedium[]" value="Phone" <?php if(in_array("Phone",$data['contactMedium'])) echo 'Checked';?>>&nbsp Phone<br><br>
	                Hobbies: <br>
	                <select multiple name="hobbies[]">
						<option value="Listening to Music" 
						<?php if(in_array("Listening to Music",$data['hobbies'])) echo 'Selected';?> >Listening to Music</option>
						<option value="Travelling"
						<?php if(in_array("Travelling",$data['hobbies'])) echo 'Selected';?> >Travelling</option>
	                	<option value="Blogging" <?php if(in_array("Blogging",$data['hobbies'])) echo 'Selected';?> >Blogging</option>
	                	<option value="Sports" <?php if(in_array("Sports",$data['hobbies'])) echo 'Selected';?>>Sports</option>
	                	<option value="Arts" <?php if(in_array("Arts",$data['hobbies'])) echo 'Selected';?>>Arts</option>
	                </select><br><br>
	            </fieldset>
	            <input type="Submit" name="Submit" value="Submit">
	        </form>
    	</div>
    	<script src="formForInformations.js"></script>
    </body>
</html>