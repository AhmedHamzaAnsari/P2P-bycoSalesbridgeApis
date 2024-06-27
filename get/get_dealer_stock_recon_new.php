<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    $dealer_id = $_GET["dealer_id"];
    $task_id = $_GET["task_id"];
    if ($pass == $access_key) {
        $sql_query1 = "SELECT rr.*,pp.name as product_name,dc.name as dealer_name FROM bycobridge.dealer_stock_recon_new as rr
        join all_products as pp on pp.id=rr.product_id
        join dealers as dc on dc.id=rr.dealer_id where rr.task_id=$task_id and rr.dealer_id=$dealer_id group by rr.product_id;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $thread[] = $user;
        }
        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} 
else 
{
    echo 'Key is Required';
}


?>