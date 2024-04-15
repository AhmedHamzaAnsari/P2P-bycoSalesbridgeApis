<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$dpt_id = $_GET['dpt_id'];
$dealer_id = $_GET['dealer_id'];
if ($pass != '') {
    if ($pass == $access_key) {
        
        $sql_query1 = "SELECT ii.*,us.name as user_name,du.department_id,du.parent_id,ii.created_at as task_create_time,tr.created_at as visit_close_time,dd.name as dealer_name FROM inspector_task as ii
        join users as us on us.id=ii.user_id
        join department_users as du on du.id=us.privilege 
        JOIN dealers AS dd ON dd.id = ii.dealer_id
        left join inspector_task_response as tr on tr.task_id=ii.id
        where du.department_id='$dpt_id' and ii.dealer_id='$dealer_id'";

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