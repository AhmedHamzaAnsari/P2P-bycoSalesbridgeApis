<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$dealers_id = $_GET["dealers_id"];
if ($pass != '') {
    // $id = $_GET["id"];
    if ($pass == $access_key) {
        $sql_query1 = "SELECT dn.*,dl.name FROM dealers_notice_board as dn
        join dealers as dl on dl.id=dn.created_by where dl.id='$dealers_id';";

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