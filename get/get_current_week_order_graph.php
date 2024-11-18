<?php
//fetch.php  
include("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"];

if ($pass != '') {
    $dealer_name = $_GET["dealer_name"];
    $product = $_GET["product"];
    if ($pass == $access_key) {
        
        // Start of the current week (Monday) and end (Sunday)
        $startOfWeek = strtotime('monday this week');
        $endOfWeek = strtotime('sunday this week');

        // Initialize an array to store the data
        $data = [];

        // Loop through each day from Monday to Sunday
        for ($day = $startOfWeek; $day <= $endOfWeek; $day += 86400) {
            $date = date('Y-m-d', $day);
            $weekday = date('l', $day); // Get the weekday name (e.g., "Monday")
            // echo $day;
            // echo '<br>';

            // Query to get total sale for the current day
            $get_sales = "SELECT SUM(bt.qty) AS total_sales FROM gotrack.bycotrip  as bt where DATE(bt.initial_time) = '$date' and bt.product='$product' and customername='$dealer_name'";
            $result_sales = $db->query($get_sales);

            // Check if the query was successful
            if ($result_sales) {
                $sale = 0;
                if ($row = $result_sales->fetch_assoc()) {
                    $sale = intval($row["total_sales"]) ?: 0; // Set to 0 if no sales
                }
            } else {
                // Output error message if query fails
                echo "Error executing query for date $date: " . $db->error;
                exit;
            }

            // Prepare the data for the current day
            $data[] = [
                "day" => strtolower($weekday),
                "date" => $date,
                "sale" => $sale
            ];
        }

        // Convert the array to a JSON string
        $jsonData = json_encode(["data" => $data]);

        // Output the JSON string
        echo $jsonData;

    } else {
        echo 'Wrong Key...';
    }
} else {
    echo 'Key is Required';
}
?>