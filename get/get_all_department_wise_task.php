<?php
// fetch.php
include("../config.php");

$access_key = '03201232927';

$pass = $_GET["key"];
$dpt_id = $_GET['dpt_id'];
$from = $_GET['from'];
$to = $_GET['to'];
$id = $_GET["user_id"];
$pre = $_GET["pre"];

if (!empty($pass)) {
    if ($pass === $access_key) {
        $thread = array();

        // Build the SQL query based on the 'pre' parameter
        $sql_query1 = "SELECT ii.*, us.name as user_name, du.department_id, du.parent_id, ii.created_at as task_create_time, tr.created_at as visit_close_time, dd.name as dealer_name 
                       FROM inspector_task as ii
                       JOIN users as us ON us.id = ii.user_id
                       JOIN department_users as du ON du.id = us.privilege
                       JOIN dealers AS dd ON dd.id = ii.dealer_id
                       LEFT JOIN inspector_task_response as tr ON tr.task_id = ii.id
                       WHERE du.department_id = '$dpt_id' AND ii.time >= '$from' AND ii.time <= '$to'";

        // Add additional condition if 'pre' is not 'Admin'
        if ($pre == '7') {
            $sql_query1 .= " AND us.subacc_id = $id";
        }else if($pre == '8'){
            $sql_query1 .= " AND ii.user_id = $id";
            
        }
        // echo $sql_query1;
        // Execute the query and fetch results
        $result1 = $db->query($sql_query1) or die("Error: " . mysqli_error($db));

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
