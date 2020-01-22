<?php
$row_col = 5;
for($i=0; $i<$row_col; $i++) {
    for($j=0; $j<$row_col; $j++) {
        if( ($i!=0) && ($i!=($row_col-1)) ) {
            if( ($j!=0) && ($j!=($row_col-1)) ) {
                echo "&nbsp&nbsp";
            }
            else {
                echo "*";    
            }
        } else {
            echo "*";
        }
    }
    echo "<br>";
}

?>