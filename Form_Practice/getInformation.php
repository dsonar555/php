<?php

function validate() {

	extract($_POST);
	// echo $firstName.'<br>';
	// echo $lastName.'<br>';
	// echo $email.'<br>';
	// echo $password.'<br>';
	// echo $confirmPassword.'<br>';
	// echo $phoneNo.'<br>';
	// echo $addressLine1.'<br>';
	// echo $addressLine2.'<br>';
	// echo $postalCode.'<br>';
	// echo $country.'<br>';
	// echo $aboutYourself.'<br>';
	// echo $city.'<br>';
	// echo $state.'<br>';
	// print_r($contactMedium);
	$isEmpty1 = (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($phoneNo)&& !empty($password) && !empty($confirmPassword) );
	$isEmpty2 = (!empty($addressLine1) && !empty($addressLine2) && !empty($postalCode) && !empty($country) && !empty($city) && !empty($state) ); 
	$isEmpty3 =  (!empty($aboutYourself) && !empty($contactMedium) );
	if( $isEmpty1 && $isEmpty2 && $isEmpty3 ) {

		if(!preg_match("/^[a-zA-Z]*$/", $firstName)) {
			echo "Enter Valid First Name";
			return false;
		}
		if(!preg_match("/^[a-zA-Z]*$/", $lastName)) {
			echo "Enter Valid Last Name";
			return false;
		}
		if(!preg_match("/^[0-9]{10,10}$/", $phoneNo)) {
			echo "Enter Valid Mobile Number";
			return false;
		}
		// if(!preg_match("/^[a-zA-Z]*$/", $addressLine2)) {
		// 	echo "Enter Valid address";
		// 	return false;
		// }
		if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) ) {
			echo "enter valid email";
			return false;
		}
		if($password != $confirmPassword)
		{
			echo "Password and Confirm password should be same.";
		} 
		if(!preg_match("/^[a-zA-Z]*$/", $city)) {
			echo "Enter Valid City Name";
			return false;
		}
		if(!preg_match("/^[a-zA-Z]*$/", $state)) {
			echo "Enter Valid State Name";
			return false;
		}
		if(!preg_match("/^[0-9]{6,8}$/", $postalCode)) {
			echo "Enter Valid Postal Code";
			return false;
		}
		return true;
	} else {
		echo "All * fields are required. ";
		return false;
	}
}

function setData() {
	extract($_POST);
	if(validate()) {
		
		$data=array(
			'prefix' => $prefix,
			'firstName' => $firstName,
			'lastName ' => $lastName,
			'birthDate' => $birthDate,
			'mobileNo' => $phoneNo,
			'email' => $email,
			'password' => $password,
			'addressLine1' => $addressLine1,
			'addressLine2' => $addressLine2,
			'company' => $company,
			'city' => $city,
			'state' => $state,
			'country' => $country,
			'postalCode' => $postalCode,
			'aboutYourself' => $aboutYourself,
			'profileImage' => $_FILES['profileImage']['name'],
			'certificate' => $_FILES['certificate']['name'],
			'businessYears' => $businessYears,
			'numberOfClients' => $numberOfClients,
			'contactMedium' => $contactMedium,
			'hobbies' => $hobbies
		);
		session_start();
		$_SESSION['data']=$data;
		// echo "session data";
		print_r($_SESSION['data']);
	}	
}



?>