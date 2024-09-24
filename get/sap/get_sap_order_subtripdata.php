<?php
//fetch.php  
include("../../old_byco_config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
// $id=$_GET["id"];
if ($pass != '') {
    if ($pass == $access_key) {
        $id = $_GET["id"];


        $sql_query1 = "SELECT bt.*,
        bt.vehiclename as vehiclenames,
        bt.depot as depot,
        bt.vehicle as uniqueId,
        bt.tripendtime as end_time,
        dc.name as vehiclename ,
        pos.latitude as lat,
        pos.longitude lng,
        IF(dc.name IS NOT NULL, 'With-Tracker', 'Without-Tracker') AS tracker_status,
        bt.initial_time as created_at, CASE
                           WHEN bt.status = 0 THEN 'On-Trip'
                           WHEN bt.status = 1 THEN 'Complete'
                           END AS current_status   FROM gotrack.bycotrip  as bt
        join devices as dc on dc.uniqueId=bt.vehicle
        join positions as pos on pos.id=dc.latestPosition_id
        where bt.id='$id' order by bt.id desc";

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