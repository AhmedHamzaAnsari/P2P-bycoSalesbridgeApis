<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$dealer_id = $_GET["dealer_id"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT *,(SELECT created_at FROM bycobridge.dealer_ledger_log where dealer_id=dl.id  order by id desc LIMIT 1) as ledger_update_time FROM dealers as dl where dl.id='$dealer_id';";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $thread[] = $user;
        }
        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>