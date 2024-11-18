<?php
// fetch.php  
include("../config.php");

// Start output buffering to control output display across browsers
ob_start();
header('Content-Type: text/plain');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$access_key = '03201232927';

$pass = $_GET["key"] ?? '';
if ($pass !== '') {
    if ($pass === $access_key) {
        // Sanitize inputs to prevent SQL injection
        $sap_no = mysqli_real_escape_string($db, $_GET['sap_no'] ?? '');
        $contact = mysqli_real_escape_string($db, $_GET['contact'] ?? '');
        $name = mysqli_real_escape_string($db, $_GET['name'] ?? '');
        $imei = mysqli_real_escape_string($db, $_GET['imei'] ?? '');

        if ($sap_no && $contact && $name && $imei) {
            // Query to check if dealer exists
            $sql_query = "SELECT * FROM dealers WHERE sap_no='$sap_no'";
            $result = mysqli_query($db, $sql_query);

            if ($result && mysqli_num_rows($result) === 1) {
                // Dealer found, proceed with insertion
               $sql_insert = "INSERT INTO `dealer_request_for_verification`
                (`sap_no`, `contact`, `dealer_name`, `imei`, `created_at`, `created_by`)
                VALUES
                ('$sap_no', '$contact', '$name', '$imei', Now(), '$sap_no')";

                $insert_result = mysqli_query($db, $sql_insert);

                if ($insert_result) {
                    echo 1; // Success
                } else {
                    echo 0; // Error in insertion
                }
            } else {
                echo 0; // Dealer not found
            }
        } else {
            echo 'All fields are required';
        }
    } else {
        echo 'Wrong Key...';
    }
} else {
    echo 'Key is Required';
}

// End output buffering and flush output to browser
ob_end_flush();
?>
