<?php
// fetch.php  
include("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"] ?? '';
$tm_id = $_GET["tm_id"] ?? '';

if (!empty($pass)) {
    if ($pass == $access_key) {
        
        // Fetch users with dealer IDs
        $sql_query1 = "SELECT * FROM users WHERE dealer_ids != '' AND id='$tm_id' ORDER BY id DESC;";
        $result1 = $db->query($sql_query1) or die("Error: " . mysqli_error($db));

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $name = $user['name'];
            $dealers = $user['dealer_ids'];

            // Fetch dealer SAP numbers
            $sql_query2 = "SELECT GROUP_CONCAT(sap_no SEPARATOR ', ') as dealer_sap FROM dealers WHERE id IN($dealers);";
            $result2 = $db->query($sql_query2) or die("Error: " . mysqli_error($db));

            while ($user2 = $result2->fetch_assoc()) {
                $dealer_sap = $user2['dealer_sap'];

                // Fetch trips related to the dealer SAP numbers
                $sql_query3 = "SELECT * FROM gotrack.bycotrip WHERE sap_no IN($dealer_sap) ORDER BY id DESC;";
                $result3 = $db->query($sql_query3) or die("Error: " . mysqli_error($db));

                while ($trip = $result3->fetch_assoc()) {
                    $thread[] = $trip; // Append trips to the thread array
                }
            }
        }

        // Return JSON response only once
        echo json_encode($thread);

    } else {
        echo json_encode(["error" => "Wrong Key..."]);
    }
} else {
    echo json_encode(["error" => "Key is Required"]);
}
?>
