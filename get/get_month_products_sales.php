<?php
//fetch.php  
include("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"];

if ($pass != '') {
    $dealer_name = $_GET["dealer_name"];
    $month = $_GET["month"]; // Get the user-provided month in format YYYY-MM

    if ($pass == $access_key) {

        // Validate the month input format
        if (DateTime::createFromFormat('Y-m', $month) === false) {
            echo 'Invalid month format. Please use YYYY-MM.';
            exit;
        }

        // Extract year and month from the input
        $year = date('Y', strtotime($month));
        $month_number = date('m', strtotime($month));

        // Query to get total sales for each product in the specified month
        $get_sales = "SELECT bt.product, SUM(bt.qty) AS total_sales 
                      FROM gotrack.bycotrip AS bt 
                      WHERE YEAR(bt.initial_time) = '$year' 
                        AND MONTH(bt.initial_time) = '$month_number'
                        AND bt.customername = '$dealer_name'
                      GROUP BY bt.product";
        $result_sales = $db->query($get_sales);

        // Initialize response data
        $data = [];

        // Check if the query was successful
        if ($result_sales) {
            while ($row = $result_sales->fetch_assoc()) {
                $data[] = [
                    "product" => $row["product"],
                    "total_sales" => intval($row["total_sales"]) ?: 0 // Set to 0 if no sales
                ];
            }
        } else {
            // Output error message if query fails
            echo "Error executing query for month $month: " . $db->error;
            exit;
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
