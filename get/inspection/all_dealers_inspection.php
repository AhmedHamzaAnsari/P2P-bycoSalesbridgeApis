<?php
//fetch.php  
include("../../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
// $id=$_GET["id"];
$from = $_GET["from"];
$to = $_GET["to"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT it.*,us.name as user_name,dd.name as dealer_name,dt.name as dpt_name,du.name as role_name,it.created_at as task_create_time,
        CASE
                WHEN it.status = 0 THEN 'Pending'
                WHEN it.status = 1 THEN 'Complete'
                WHEN it.status = 2 THEN 'Cancel'
                END AS current_status,dd.region,dd.province,dd.city,dd.actual_depot,dd.terr,dd.cat_1,dd.cat_2
         FROM inspector_task as it
                join dealers as dd on dd.id=it.dealer_id
                join users as us on us.id=it.user_id 
                join department_users as du on du.id=us.privilege
                join department as dt on dt.id=du.department_id where it.time>='$from' and it.time<='$to';";

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