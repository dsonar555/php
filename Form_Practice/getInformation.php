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
	$isEmpty2 = (!empty($addressLine1) && !empty($addressLine2) && !empty($postalCode) && !empty($country) && ($country!='select country') && !empty($city) && !empty($state) ); 
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
			'businessYears' => $businessYears,
			'numberOfClients' => $numberOfClients,
			'contactMedium' => $contactMedium,
			'hobbies' => $hobbies,
			'path'=> 'uploads/'
		);
		if(uploadFile($_FILES['profileImage'],"Image")) {
			$data['profileImage'] = $_FILES['profileImage']['name'];
		}
		if(uploadFile($_FILES['certificate'],"Pdf")) {
			$data['certificate'] = $_FILES['certificate']['name'];
		}
		$_SESSION['data']=$data;
		// echo "session data";
		print_r($_SESSION['data']);
	}	
}
function uploadFile($file,$OfTypeOnly) {
    $fileName = $file['name'];   
    $extension = strtolower(substr($fileName, strpos($fileName, '.')+1)); 
    $tmp_name = $file['tmp_name'];
    if(!empty($file)) {
        $size = $file['size'].'<br>';
        $maxSize = 10000;
        $type = $file['type'];
        // echo $file['tmp_name'].'<br>';
        // echo $file['error'];
		$location = 'uploads/';
		if($OfTypeOnly == 'Image')	{
			if( (($extension=='jpeg') || ($extension=='jpg') || ($extension=='png')) && $type=='image/jpeg' ) { 
				if(move_uploaded_file($tmp_name, $location.$fileName)) {
					// echo 'Uploaded!';
					return true;
				} else {
					echo "Error in uploading";
					return false;
				}
			} else {
				echo "File must be jpeg, png or jpg.";
				return false;
			}
		}
		else if($OfTypeOnly == 'Pdf')
		{
			if( ($extension=='pdf') && $type=='application/pdf' ) { 
				if(move_uploaded_file($tmp_name, $location.$fileName)) {
					// echo 'Uploaded!';
					return true;
				} else {
					echo "Error in uploading";
					return false;
				}
			} else {
				echo "File must be png";
				return false;
			}
		}
    } else {
		echo "Please choose a file";
		return false;
    }
}


?>