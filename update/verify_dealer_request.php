<?php
include("../config.php");
session_start();

if (isset($_POST)) {
    // Required POST variables
    $row_id = $_POST['row_id'];
    $name = $_POST['name'];
    $sap_no = $_POST['dealer_sap'];
    $imei = $_POST['imei'];
    $set_password = $_POST['set_password'];
    $datetime = date('Y-m-d H:i:s');

    $output = 0;

    // Query to check if the dealer exists
    $sql_query1 = "SELECT * FROM dealers WHERE sap_no='$sap_no';";
    $result = mysqli_query($db, $sql_query1);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $dealer_id = $row['id'];

        // Update the dealer verification status and IMEI
        $verify = "UPDATE dealers
                   SET is_verify = '1',
                       login_imei = '$imei',
                       `password` = '$set_password'
                   WHERE sap_no = '$sap_no' AND id='$dealer_id';";

        if (mysqli_query($db, $verify)) {
            // Successfully updated the dealer status, return dealer info
            $output = json_encode($row);

            // Update the verification request status
            $query = "UPDATE dealer_request_for_verification
                      SET is_verify = '1',
                          verify_time = '$datetime'
                      WHERE id = '$row_id';";

            if (mysqli_query($db, $query)) {
                // Log the device login for the dealer
                $log = "INSERT INTO dealer_login_devices
                        (dealer_id, dealer_sap, imei, created_at, created_by)
                        VALUES ('$dealer_id', '$sap_no', '$imei', NOW(), '$dealer_id');";
                
                mysqli_query($db, $log);
                $output = 1;
            } else {
                $output = 0; // Error updating verification request status
            }
        } else {
            $output = 0; // Error updating dealer verification status
        }
    } else {
        $output = 0; // Dealer not found
    }

    echo $output;
}
?>
