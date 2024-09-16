<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {

        $dealer_id = $_GET["dealer_id"];

        // Initialize an array to store the data
        $data = [];
        $month_series = 1;


        $sql = "SELECT * FROM dealers_dispenser where dealer_id=$dealer_id;";

        $result = $db->query($sql);


        $dealerProductCounts = [];
        $myArray = [];

        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $name = $row["name"];

            $dealerProductCounts = [];
            $myArray = [];

            $get_orders = "SELECT  YEAR(nn.created_at) AS sales_year,
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
            // echo $get_orders .'<br>';
            $result_orders = $db->query($get_orders);

            while ($row_2 = $result_orders->fetch_assoc()) {


                // Push the values into the array
                // $myArray[$productType] = $count;
                $myArray[] = $row_2;
            }

            $dealerProductCounts = [

                "id" => $id,
                "name" => $name,
                "nozels" => $myArray,
            ];
            $data[] = $dealerProductCounts;
        }

        // Format the data for the current month

        $month_series++;


        // Convert the array to a JSON string
        $jsonData = json_encode($data);

        // Output the JSON string
        // echo $jsonData;


        // Output the JSON string
        echo $jsonData;


    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>