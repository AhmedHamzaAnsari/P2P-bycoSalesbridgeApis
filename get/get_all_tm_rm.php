<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$id = $_GET["id"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT us.*,du.name as pre_name,dt.name as dpt_name FROM bycobridge.department_users as du 
        join users as us on us.privilege=du.id
        join department as dt on dt.id=du.department_id
        where dt.name='Retail Network' and du.name='TM' and us.subacc_id='$id';";

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