<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$task_id=$_GET['task_id'];
$dealer_id=$_GET['dealer_id'];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT qc.*,pp.name as product_name FROM dealer_inspection_price_check as qc
        join dealers_products as dp on dp.name=qc.product_id
        join all_products as pp on pp.id=dp.name where qc.task_id='$task_id' and qc.dealer_id='$dealer_id';";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

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