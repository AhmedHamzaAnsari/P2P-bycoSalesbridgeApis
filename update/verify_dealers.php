<?php
//fetch.php  
include("../config.php");

$access_key = '03201232927';

$pass = $_GET["key"] ?? '';
if ($pass !== '') {
    if ($pass === $access_key) {
        $sap_no = $_GET['sap_no'] ?? '';
        $contact = $_GET['contact'] ?? '';
        $name = $_GET['name'] ?? '';
        $imei = $_GET['imei'] ?? '';

        $sql_query1 = "SELECT * FROM dealers WHERE sap_no='$sap_no';";
        $result = mysqli_query($db, $sql_query1);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $dealer_id = $row['id'];

            $verify = "UPDATE dealers
                SET is_verify = '1',
                    login_imei = '$imei'
                WHERE sap_no = '$sap_no' AND id = '$dealer_id';";

            if (mysqli_query($db, $verify)) {
                $output = json_encode($row);;

                $log = "INSERT INTO dealer_login_devices
                    (dealer_id, dealer_sap, imei, created_at, created_by)
                    VALUES ('$dealer_id', '$sap_no', '$imei', NOW(), '$dealer_id');";

                mysqli_query($db, $log);

            } else {
                $output = 0;
            }
        } else {
            $output = 0;
        }

        echo $output;

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}
?>