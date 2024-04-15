<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$id = $_GET["id"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT od.*,geo.name,geo_d.consignee_name,dp.name as product_name FROM order_detail as od 
        join dealers as geo on geo.id = od.cus_id 
       left join geofenceing as geo_d on geo_d.id=od.depot
        join dealers_products as dp on dp.id=od.product_type
        where od.main_id = $id  order by od.id desc";

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