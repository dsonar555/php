<?php 

// $fileHandle = fopen('demoFile.txt','a');
// fwrite($fileHandle, "\n".'Now I am on video of appending into files.');
// fwrite($fileHandle, "\n".'Practicing append.');
// fclose($fileHandle);

if(isset($_POST['data']))
{
    $data = $_POST['data'];
    $fileHandle = fopen('demoFile.txt','a');
    fwrite($fileHandle, $data);
    fclose($fileHandle);
}

?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form action="appendIntoFile.php" method="POST">
            Text to write in file : <br>
            <textarea rows="5" cols="30" name="data"></textarea><br><br>
            <input type="submit" value="Add to File">
        </form>
    </body>
</html>