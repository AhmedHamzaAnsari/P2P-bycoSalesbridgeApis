<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT us.*,du.name as role,dt.name as department_name,dup.name as parent_name FROM users as us 
        join department_users as du on du.id=us.privilege
        join department as dt on dt.id=du.department_id
        left join users as dup on dup.id=us.subacc_id order by du.id asc;";
        // left join department_users as dup on dup.id=du.parent_id order by du.id asc;";

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