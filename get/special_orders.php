<?php
// fetch.php
include("../config.php");

$access_key = '03201232927';

$pass = $_GET["key"];
$pre = $_GET["pre"];
$id = $_GET["user_id"];

if (!empty($pass)) {
    if ($pass === $access_key) {

        // SQL query based on the role type in `$pre`
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
                $condition = "1"; // no additional filtering for default case
                break;
        }

        // Main SQL query with dynamic condition
        $sql_query1 = "SELECT od.*, d.name, geo.consignee_name, d.zm, d.tm, d.asm,d.sap_no
            FROM order_main od
            JOIN dealers d ON d.id = od.created_by
            LEFT JOIN geofenceing geo ON geo.id = od.depot
            WHERE od.status = 1 AND $condition
            ORDER BY od.id DESC;
        ";

        // Execute query and fetch results
        $result1 = $db->query($sql_query1) or die("Error: " . mysqli_error($db));

        // Collect and return data as JSON
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
