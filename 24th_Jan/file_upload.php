<?php
if(isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    $fileName = $_FILES['fileToUpload']['name'];    
    $tmp_name = $file['tmp_name'];
    if(!empty($file)) {
        $size = $file['size'].'<br>';
        $maxSize = 1000;
        // echo $file['type'].'<br>';
        // echo $file['tmp_name'].'<br>';
        // echo $file['error'];
        $location = 'uploads/';
        if( $size <= $maxSize ) {
            if(move_uploaded_file($tmp_name, $location.$fileName)) {
                echo 'Uploaded!';
            } else {
                echo "Error in uploading";
            }
        } else {
            echo "File Size must be less than $maxSize";
        }
    } else {
        echo "Please choose a file";
    }
}


?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form action="file_upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload"><br><br>
            <input type="submit" value="Upload">
        </form>
    </body>
</html>