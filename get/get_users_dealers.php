<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$user_id = $_GET["user_id"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM users where dealer_ids!='' and id='$user_id' order by id desc;";
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