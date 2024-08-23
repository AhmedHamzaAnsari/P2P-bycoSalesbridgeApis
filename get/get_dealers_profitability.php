<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    $dealer_id = $_GET["dealer_id"];
    $task_id = $_GET["task_id"];
    if ($pass == $access_key) {
              $data = [];
        $month_series = 1;


        $sql = "SELECT * FROM bycobridge.dealers_profitability_main where task_id=$task_id order by id desc";

        $result = $db->query($sql);


        $dealerProductCounts = [];
        $myArray = [];
        $net_incomw = 0;
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $type = $row["type"];

            $dealerProductCounts = [];
            $myArray = [];

            $get_orders = "SELECT id,retailer_profitability,$type as data_val FROM bycobridge.dealers_profitability where main_id=$id ;";
            // echo $get_orders .'<br>';
            $result_orders = $db->query($get_orders);

            while ($row_2 = $result_orders->fetch_assoc()) {


                // Push the values into the array
                // $myArray[$productType] = $count;
                $myArray[] = $row_2;
            }

            $dealerProductCounts = [

                "id" => $id,
                "type" => $type,
                "data" => $myArray,
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

} 
else 
{
    echo 'Key is Required';
}




?>