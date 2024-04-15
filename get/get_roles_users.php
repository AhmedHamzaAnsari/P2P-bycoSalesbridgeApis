<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$role_id = $_GET['role_id'];
if ($pass != '') {
    if ($pass == $access_key) {


        $sql_query1 = "SELECT * FROM users where privilege=$role_id order by id desc";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));


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