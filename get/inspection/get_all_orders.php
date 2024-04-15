<?php
//fetch.php  
include("../../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
// $id=$_GET["id"];
$from = $_GET["from"];
$to = $_GET["to"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT od.*,dd.name,geo_d.consignee_name ,ap.name as product_name,
        dd.region,dd.province,dd.city,dd.actual_depot,dd.terr,dd.cat_1,dd.cat_2,
        CASE
        WHEN od.status = 0 THEN 'Pending'
        WHEN od.status = 1 THEN 'Complete'
        WHEN od.status = 2 THEN 'Cancel'
        END AS current_status
        FROM order_detail as od 
        join dealers as dd on dd.id = od.cus_id 
        left join geofenceing as geo_d on geo_d.id=od.depot
        join all_products as ap on ap.id=od.product_type
        where od.date>='$from' and od.date<='$to'
        order by od.id desc;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

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