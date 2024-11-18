<?php
// fetch.php
include("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"];
$pre = $_GET["pre"];
$id = $_GET["user_id"];
$from = $_GET["from"];
$to = $_GET["to"];

if (!empty($pass)) {
    if ($pass === $access_key) {

        // Determine SQL condition based on privilege level ($pre)
        switch ($pre) {
            case 'ZM':
                $condition = "d.zm = '$id'";
                break;
            case 'TM':
                $condition = "d.tm = '$id'";
                break;
            case 'ASM':
                $condition = "d.asm = '$id'";
                break;
            default:
                $condition = "1";  // No additional filter in default case
                break;
        }

        // Main SQL query with dynamic filtering
        $sql_query1 = "SELECT od.*, d.name, geo.consignee_name, d.zm, d.tm, d.asm,d.sap_no
            FROM order_main od
            JOIN dealers d ON d.id = od.created_by
            LEFT JOIN geofenceing geo ON geo.id = od.depot
            WHERE od.created_at>='$from' and od.created_at<='$to' and $condition
            ORDER BY od.id DESC;
        ";

        // Execute query and handle results
        $result1 = $db->query($sql_query1) or die("Error: " . mysqli_error($db));
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
