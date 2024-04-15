<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    $id = $_GET["id"];
    if ($pass == $access_key) {
        $sql_query1 = "SELECT du.*,dt.name as dpt_name,dup.name as parent_name FROM department_users as du 
        join department as dt on dt.id=du.department_id 
        left join department_users as dup on dup.id=du.parent_id order by dt.id asc";

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