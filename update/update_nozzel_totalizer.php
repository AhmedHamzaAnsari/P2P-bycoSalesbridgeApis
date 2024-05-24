
<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    // Existing code...
    $nozzel_id=$_POST['nozzel_id'];


    $query = "UPDATE `dealers_nozzel` SET `totalizer` = (`totalizer` + 1) WHERE id='$nozzel_id'";;

    if(mysqli_query($db, $query)){

        echo 1;
    }else{
        
        echo 0;
    }

}
