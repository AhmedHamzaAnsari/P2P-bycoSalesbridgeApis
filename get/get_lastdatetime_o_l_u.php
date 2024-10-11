<?php
// fetch.php  
include("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"] ?? ''; // Use null coalescing to avoid undefined index notice
$dealer_id = $_GET["dealer_id"] ?? ''; // Use null coalescing to avoid undefined index notice

if ($pass !== '') {
    if ($pass === $access_key) {
        // Prepare SQL queries
        $last_fuel_order_time_query = "SELECT created_at AS last_fuel_order_time FROM bycobridge.order_main WHERE created_by='$dealer_id' ORDER BY created_at DESC LIMIT 1;";
        $last_lubes_order_time_query = "SELECT created_at AS last_lubes_order_time FROM bycobridge.lubes_order_main WHERE dealer_id='$dealer_id' ORDER BY created_at DESC LIMIT 1;";
        $last_uni_order_time_query = "SELECT recorddate AS last_uni_order_time FROM bycobridge.uni_order WHERE userid='$dealer_id' ORDER BY recorddate DESC LIMIT 1;";

        // Initialize result array with null values for all fields
        $result = [
            'last_fuel_order_time' => null,
            'last_lubes_order_time' => null,
            'last_uni_order_time' => null,
        ];

        // Function to execute the query and fetch results
        function fetchResult($db, $query, $field) {
            if ($resultSet = $db->query($query)) {
                $row = $resultSet->fetch_assoc();
                return $row ? $row[$field] : null; // Return the field value or null if not found
            } else {
                die(json_encode(["error" => "Error fetching data: " . $db->error]));
            }
        }

        // Execute the queries and store the results
        $result['last_fuel_order_time'] = fetchResult($db, $last_fuel_order_time_query, 'last_fuel_order_time');
        $result['last_lubes_order_time'] = fetchResult($db, $last_lubes_order_time_query, 'last_lubes_order_time');
        $result['last_uni_order_time'] = fetchResult($db, $last_uni_order_time_query, 'last_uni_order_time');

        // Return the result as JSON
        echo json_encode($result);

    } else {
        echo json_encode(['error' => 'Wrong Key...']);
    }

} else {
    echo json_encode(['error' => 'Key is Required']);
}
?>
