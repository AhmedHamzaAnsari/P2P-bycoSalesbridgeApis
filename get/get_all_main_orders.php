<?php
// fetch.php  
include("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"] ?? '';
$pre = $_GET["pre"] ?? '';
$id = $_GET["user_id"] ?? '';

if ($pass) {
    if ($pass === $access_key) {
        // Determine condition based on privilege level
        $privilegeCondition = '1=1'; // Default condition
        if ($pre === 'ZM') {
            $privilegeCondition = "dl.zm = $id";
        } elseif ($pre === 'TM') {
            $privilegeCondition = "dl.tm = $id";
        } elseif ($pre === 'ASM') {
            $privilegeCondition = "dl.asm = $id";
        }

        // SQL query
        $sql_query1 = "SELECT 
            om.*, 
            geo.consignee_name, 
            dl.name, dl.zm, dl.tm, dl.asm,dl.sap_no,
            CASE
                WHEN om.status = 0 THEN 'Pending'
                WHEN om.status = 1 THEN 'Approved'
                WHEN om.status = 2 THEN 'Complete'
                WHEN om.status = 3 THEN 'Cancel'
                WHEN om.status = 4 THEN 'Special Approval'
                WHEN om.status = 5 THEN 'ASM Approved'
            END AS current_status
        FROM order_main AS om
        LEFT JOIN geofenceing AS geo ON geo.id = om.depot
        JOIN dealers AS dl ON dl.id = om.created_by
        WHERE om.status IN (0, 5) AND $privilegeCondition
        ORDER BY om.id DESC;
        ";

        // Execute query
        $result1 = $db->query($sql_query1) or die("Error: " . $db->error);

        $thread = [];
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
