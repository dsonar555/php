<?php 
// <?php echo $_PHP['PHP_SELF']
$offset = 0;
if( isset($_POST['user_input']) &&  isset($_POST['search']) && isset($_POST['replace']) ) {

    $user_input = $_POST['user_input'];
    $search = $_POST['search'];
    $replace = $_POST['replace'];
    
    if(!empty($user_input) && !empty($search) && !empty($replace)) {
        $searchLength = strlen($search);
        $strpos = strpos($user_input, $search, $offset);
        do {
            $offset = $strpos + $searchLength;
            $text = substr_replace($user_input, $replace, $strpos, $offset);
        } while($strpos = strpos($user_input, $search, $offset) );
    } else {
        echo "Please fill in all fields.";
    }
    echo $text;
}

?>
<hr>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form method="post" action="wordCensoring.php">
            <textarea rows="5" cols="40" name="user_input"><?php if(isset($_POST['user_input'])) echo $user_input; ?></textarea><br><br>
            Search For: <input type="text" name="search"><br><br>
            Replace With: <input type="text" name="replace"><br><br>
            <input type="submit" value="Search and Replace">
        </form>
    </head>
</html>