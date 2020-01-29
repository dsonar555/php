<?php

require 'set_get_databaseData.php';
$result = getAllValues('account');


?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <table>
            <tr>
                <th>Prefix</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>BirthDate</th>
                <th>Mobile No.</th>
                <th>Email</th>
                <th>Password</th>
                <th>Operation</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)) :?>
            <tr>
                <td><?=$row['prefix']?></td>
                <td><?=$row['firstName']?></td>
                <td><?=$row['lastName']?></td>
                <td><?=$row['birthDate']?></td>
                <td><?=$row['mobileNo']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['password']?></td>
                <td><a href="FormTaskUsingDatabase.php?customer_id=<?=$row['customer_id']?>">Edit</a></td>
            </tr>
            <?php endwhile;?>
        </table>
    </body>
</html>