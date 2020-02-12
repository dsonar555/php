<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        <h1>Welcome <?php echo htmlspecialchars($name);?></h1>
        <p>You are in the index page of Home.</p>
        <ul>
        <?php foreach($colors as $color):?>
        <li><?php echo htmlspecialchars($color); ?></li>
        <?php endforeach;?>
        </ul>
    </body>
</html>
