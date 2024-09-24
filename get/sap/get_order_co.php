<?php
//fetch.php  
include("../../old_byco_config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
// $id=$_GET["id"];
if ($pass != '') {
    if ($pass == $access_key) {
        $id = $_GET["id"];


        $sql_query1 = "SELECT 
        bt.*,
        bt.vehiclename AS vehiclenames,
        bt.depot AS depot,
        bt.vehicle AS uniqueId,
        bt.tripendtime AS end_time,
        dc.name AS vehiclename,
        pos.latitude AS lat,
        pos.longitude AS lng,
        pos.time AS time,
        geo.Coordinates AS dealer_co,
        IF(dc.name IS NOT NULL, 'With-Tracker', 'Without-Tracker') AS tracker_status,
        bt.initial_time AS created_at, 
        CASE
            WHEN bt.status = 0 THEN 'On-Trip'
            WHEN bt.status = 1 THEN 'Complete'
        END AS current_status
    FROM 
        gotrack.bycotrip AS bt
    JOIN 
        devices AS dc ON dc.uniqueId = bt.vehicle
    JOIN 
        positions AS pos ON pos.id = dc.latestPosition_id
    LEFT JOIN 
        geofenceing AS geo ON geo.consignee_name = bt.depot
    WHERE 
        bt.id = '$id'
    ORDER BY 
        bt.id DESC";

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