<?php

    // $rand = rand();
    // $maxNumber = getrandmax();

    // echo "The random number is: $rand <br>";
    // echo "The maximum random number is: $maxNumber <br>";

    if(isset($_POST['dice'])) {
        $rand = rand(1, 6);
        echo "number on dice : $rand";
    }
?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form action="randomNumber.php" method="POST">
            <input type="submit" name="dice" value="Roll Dice">
        </form>
    </body>
</html>