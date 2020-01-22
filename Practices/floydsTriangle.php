<?php
$counter=1;
for($i=0; $i<=5; $i++)
{
    for($j=0; $j<$i; $j++)
    {
        echo $counter;
        $counter++;
    }
    echo '<br>';
}

?>