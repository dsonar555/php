<?php 
session_start();
if(isset($_POST['showCalendar'])) {
    $fromYear = $_POST['fromYear'];
    $toYear = $_POST['toYear'];
    $fromMonth = $_POST['fromMonth'];
    $toMonth = $_POST['toMonth'];
    // $file = $_FILES['image'];
    // if(uploadImage($file)) {
    //     $_SESSION['image'] = $file['name'];
    //     $_SESSION['path'] = 'uploads/';
    // }
    if(!empty($fromMonth) && !empty($toMonth) && !empty($fromYear) && !empty($toYear))
    {
        $fromMonthValidation = ( ($fromMonth > 0) && ($fromMonth <= 12) && preg_match('/^\d{0,2}$/',$fromMonth) );
        $toMonthValidation = ( ($toMonth > 0) && ($toMonth <= 12) && preg_match('/^\d{0,2}$/',$toMonth) );
        $fromYearValidation = ( preg_match('/^\d{0,4}$/',$fromYear) && ($fromYear > 0) && ($fromYear <= 9999) );
        $toYearValidation = ( preg_match('/^\d{0,4}$/',$toYear) && ($toYear > 0) && ($toYear <= 9999) );
        if( $toYearValidation  && $fromYearValidation &&  $fromMonthValidation && $toMonthValidation ){
            $_SESSION['toYear'] = $toYear;
            $_SESSION['fromYear'] = $fromYear;
            $_SESSION['toMonth'] = $toMonth;
            $_SESSION['fromMonth'] = $fromMonth;
            list($begin, $end, $interval, $daterange) = setInterval($fromYear, $toYear, $fromMonth, $toMonth);
        } else {
            echo "Enter valid year and month";
            $fromYear = $_SESSION['fromYear'];
            $toYear = $_SESSION['toYear'];
            $fromMonth = $_SESSION['fromMonth'];
            $toYear = $_SESSION['toYear'];
            list($begin, $end, $interval, $daterange) = setInterval($fromYear, $toYear, $fromMonth, $toMonth);
        }
    } else {
        echo "Enter the Year and Month";
        $fromYear = $_SESSION['fromYear'];
        $toYear = $_SESSION['toYear'];
        $fromMonth = $_SESSION['fromMonth'];
        $toYear = $_SESSION['toMonth'];
        list($begin, $end, $interval, $daterange) = setInterval($fromYear, $toYear, $fromMonth, $toMonth);
    }
 } else if(isset($_SESSION['fromYear']) && isset($_SESSION['fromMonth']) &&isset($_SESSION['toYear']) && isset($_SESSION['toMonth']) ){
    $fromYear = $_SESSION['fromYear'];
    $toYear = $_SESSION['toYear'];
    $fromMonth = $_SESSION['fromMonth'];
    $toMonth = $_SESSION['toMonth'];
    list($begin, $end, $interval, $daterange) = setInterval($fromYear, $toYear, $fromMonth, $toMonth);
}
else {
    $fromYear = 2019;
    $toYear = 2020;
    $fromMonth = 03;
    $toMonth = 02;
    list($begin, $end, $interval, $daterange) = setInterval($fromYear, $toYear, $fromMonth, $toMonth);
}
function printDate($begin,$end)
{
    echo $begin->format("d");
    if($begin->format("d-m-y") != $end->format("d-m-y"))
        $begin->modify("+1 day");
}
function setInterval($fromYear, $toYear, $fromMonth, $toMonth)
{
    $begin = new DateTime("$fromYear-$fromMonth-01",new DateTimeZone("Asia/Kolkata"));
    $end = new DateTime("$toYear-$toMonth-01",new DateTimeZone("Asia/Kolkata"));
    $end = $end->modify("first day of next month");
    $interval = new DateInterval('P7D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    // $end = $end->modify("-1 day");
    return array($begin,$end,$interval,$daterange);
}
function uploadImage($file) {
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
		if( (($extension=='jpeg') || ($extension=='jpg')) && $type=='image/jpeg' ) { 
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
}

?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="year_month_form_to.php" enctype="multipart/form-data">
            From Year :<br>
            <input type="text" name="fromYear"><br><br>
            To Year :<br>
            <input type="text" name="toYear"><br><br>
            From Month :<br>
            <input type="text" name="fromMonth"><br><br>
            To Month :<br>
            <input type="text" name="toMonth"><br><br>
            <!-- <input type="file" name="image"><br><br> -->
            <input type="submit" name="showCalendar">
        </form>
        <hr>
        <?php 
            // if(isset($_SESSION['image']) && isset($_SESSION['path']))
            // {
            //     echo '<img src="'.$_SESSION['path'].$_SESSION['image'].'"';
            // }
        ?>
        <div>
            
        <!-- <table border="1" background = "<?php //echo $_SESSION['path'].$_SESSION['image']?>"> -->
            <?php 
               foreach($daterange as $date) { 
                if($begin->format("d") == 1)
                {
                    echo $begin->format("d").'<br>';
                    echo '<table>';
                    echo '<tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    </tr>';
                    $numberofDays = $begin->format('t');
                    echo $numberofDays.'<br>';
                }
            ?>
            <tr>
                <td><?php if($begin->format("D")=="Sun") {
                     printDate($begin,$end);
                    }  ?></td>
                <td><?php if($begin->format("D")=="Mon") {
                     printDate($begin,$end);
                    }  ?></td>
                <td><?php if($begin->format("D")=="Tue") {
                     printDate($begin,$end);
                    }  ?></td>
                <td><?php if($begin->format("D")=="Wed") {
                     printDate($begin,$end);
                    }  ?></td>
                <td><?php if($begin->format("D")=="Thu") {
                     printDate($begin,$end);
                    }  ?></td>
                <td><?php if($begin->format("D")=="Fri") {
                     printDate($begin,$end);
                    }  ?></td>
                <td><?php if($begin->format("D")=="Sat") {
                     printDate($begin,$end);
                    }  ?></td>
            </tr>
            <?php
                if($begin->format('d') == $numberofDays) {
                    echo '</table>';
                }   
            }
            ?> 
        </div>
    </body>
</html>