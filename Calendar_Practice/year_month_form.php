<?php 
session_start();
if(isset($_POST['showCalendar'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];
    $file = $_FILES['image'];
    if(uploadImage($file)) {
        $_SESSION['image'] = $file['name'];
        $_SESSION['path'] = 'uploads/';
    }
    if(!empty($year) && !empty($month))
    {
        $monthValidation = ( ($month > 0) && ($month <= 12) && preg_match('/^\d{0,2}$/',$month) );
        $yearValidation = ( preg_match('/^\d{0,4}$/',$year) && ($year > 0) && ($year <= 9999) );
        if( $yearValidation  &&  $monthValidation ){
            $_SESSION['year'] = $year;
            $_SESSION['month'] = $month;
            list($begin, $end, $interval, $daterange) = setInterval($year, $month);
        } else {
            echo "Enter valid year and month";
            $year = $_SESSION['year'];
            $month = $_SESSION['month'];
            list($begin, $end, $interval, $daterange) = setInterval($year, $month);
        }
    } else {
        echo "Enter the Year and Month";
        $year = $_SESSION['year'];
        $month = $_SESSION['month'];
        list($begin, $end, $interval, $daterange) = setInterval($year, $month);
    }
} else if(isset($_SESSION['year']) && isset($_SESSION['month']) ){
    $year = $_SESSION['year'];
    $month = $_SESSION['month'];
    list($begin, $end, $interval, $daterange) = setInterval($year, $month);
}
function printDate($begin,$end)
{
    echo $begin->format("d");
    if($begin->format("d") != $end->format("d"))
        $begin->modify("+1 day");
}
function setInterval($year, $month)
{
    $begin = new DateTime("$year-$month-01",new DateTimeZone("Asia/Kolkata"));
    $end = new DateTime("$year-$month-01",new DateTimeZone("Asia/Kolkata"));
    $end = $end->modify("first day of next month");
    $interval = new DateInterval('P7D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    $end = $end->modify("-1 day");
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
        <form method="POST" action="year_month_form.php" enctype="multipart/form-data">
            Year :<br>
            <input type="text" name="year"><br><br>
            Month :<br>
            <input type="text" name="month"><br><br>
            <input type="file" name="image"><br><br>
            <input type="submit" name="showCalendar">
        </form>
        <hr>
        <?php 
            if(isset($_SESSION['image']) && isset($_SESSION['path']))
            {
                echo '<img src="'.$_SESSION['path'].$_SESSION['image'].'"';
            }
        ?>
        <div>
        <table border="1" background = "<?php echo $_SESSION['path'].$_SESSION['image']?>">
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            <?php 
               foreach($daterange as $date) {
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
               }
            ?> 
        </table>
        </div>
    </body>
</html>