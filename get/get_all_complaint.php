<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    $dealer_id = $_GET["id"];
    if ($pass == $access_key) {
        $sql_query1 = "SELECT cc.*,dl.name as dealer_name,dl.sap_no FROM complaints as cc
        join dealers as dl on dl.id=cc.created_by
        order by cc.id desc; ";

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