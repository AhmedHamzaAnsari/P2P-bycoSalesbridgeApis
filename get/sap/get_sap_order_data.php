<?php
//fetch.php  
include("../../old_byco_config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
// $id=$_GET["id"];
if ($pass != '') {
    if ($pass == $access_key) {
        $from = $_GET["from"];
        $to = $_GET["to"];


        $sql_query1 = "SELECT bt.*,bt.vehiclename as vehiclenames,bt.depot as depot,bt.vehicle as uniqueId,bt.tripendtime as end_time,dc.name as vehiclename ,pos.latitude as lat,pos.longitude lng,IF(dc.name IS NOT NULL, 'With-Tracker', 'Without-Tracker') AS tracker_status,bt.initial_time as created_at  FROM gotrack.bycotrip  as bt
        join devices as dc on dc.uniqueId=bt.vehicle
        join positions as pos on pos.id=dc.latestPosition_id where initial_time>='$from' and initial_time<='$to' order by id desc";

    
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