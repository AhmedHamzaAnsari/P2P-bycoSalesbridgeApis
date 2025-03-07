<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$tm_id = $_GET["tm_id"];
$from = $_GET["from"];
$to = $_GET["to"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM users where dealer_ids!='' and id='$tm_id' order by id desc;";
        // left join department_users as dup on dup.id=du.parent_id order by du.id asc;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $name = $user['name'];
            $dealers = $user['dealer_ids'];

            $sql_query2 = "SELECT id,sap_no,name,
            (SELECT COUNT(DISTINCT rr.task_id) AS total_count
            FROM bycobridge.inspector_task AS it
            JOIN bycobridge.dealer_stock_recon_new AS rr ON rr.task_id = it.id
            WHERE it.dealer_id = dl.id 
            AND DATE(it.time) BETWEEN '$from' AND '$to') as total_count,
            (SELECT COUNT(DISTINCT it.dealer_id) AS total_dealers
            FROM bycobridge.inspector_task AS it
            JOIN bycobridge.dealer_stock_recon_new AS rr ON rr.task_id = it.id
            WHERE DATE(it.time) BETWEEN '$from' AND '$to' and  it.dealer_id = dl.id) as distinct_count
             FROM dealers as dl where dl.id IN($dealers);";
            // left join department_users as dup on dup.id=du.parent_id order by du.id asc;";

            $result2 = $db->query($sql_query2) or die("Error :" . mysqli_error());

           
            while ($user2 = $result2->fetch_assoc()) {
                // $dealer_name = $user2['dealer_name'];
                $thread[] = $user2;



            }
        }
        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>