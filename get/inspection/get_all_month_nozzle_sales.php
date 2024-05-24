<?php
//fetch.php  
include ("../../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
// $id=$_GET["id"];
$from = $_GET["from"];
$to = $_GET["to"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT 
        YEAR(nd.created_at) AS sales_year,
        MONTH(nd.created_at) AS sales_month,
        SUM(nd.new_reading - nd.old_reading) AS total_sales,
        SUM(nd.new_reading) AS total_new_reading,
        SUM(nd.old_reading) AS total_old_reading,
        dd.name,dd.region,dd.province,dd.city,dd.actual_depot,dd.terr,dd.cat_1,dd.cat_2,date(nd.created_at) as date_month
        FROM dealers_nozzel_readings AS nd
        JOIN  dealers AS dd ON dd.id = nd.dealer_id where nd.created_at>='$from' and nd.created_at<='$to'
        GROUP BY YEAR(nd.created_at),MONTH(nd.created_at),dd.name ORDER BY YEAR(nd.created_at),MONTH(nd.created_at);";

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