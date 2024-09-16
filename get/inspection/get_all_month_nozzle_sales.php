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
        $sql_query1 = "SELECT  YEAR(nn.created_at) AS sales_year,
        MONTH(nn.created_at) AS sales_month,
        SUM(nn.new_reading - nn.old_reading) AS total_sales,
        SUM(nn.new_reading) AS total_new_reading,
        SUM(nn.old_reading) AS total_old_reading,
        dd.name,dd.region,dd.province,dd.city,dd.actual_depot,dd.terr,dd.cat_1,dd.cat_2,date(nn.created_at) as date_month,nn.product_id,ap.name as product_name
            FROM dealers_nozzel dz 
            join dealers_products as dp on dp.id=dz.products
            join all_products as ap on ap.id=dz.products 
            join dealers_nozzel_readings as nn on nn.nozle_id=dz.id
             JOIN  dealers AS dd ON dd.id = nn.dealer_id 
            where nn.created_at>='$from' and nn.created_at<='$to' group by dz.products,dd.id;";

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