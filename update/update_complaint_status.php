<?php
include("../config.php");
session_start();
if (isset($_POST)) {


    $user_id = $_POST['user_id'];
    $orderno = $_POST['orderno'];
    $order_approval = $_POST['order_approval'];
    $approved_order_status = mysqli_real_escape_string($db, $_POST['approved_order_status']);
    $approved_order_description = mysqli_real_escape_string($db, $_POST['approved_order_description']);
    $datetime = date('Y-m-d H:i:s');
    $val = '';

    // echo 'HAmza';

    if ($approved_order_status == 0) {
        $val = 'Pending';
    } elseif ($approved_order_status == 1) {
        $val = 'In-Process';

    } elseif ($approved_order_status == 2) {
        $val = 'Completed';

    }

    $query = "UPDATE `complaints` SET 
    `status`='$approved_order_status',
    `status_value`='$val',
    `Comments`='$approved_order_description',
    `complaint_no`='$orderno',
    `action_time`='$datetime' WHERE id=$order_approval";


    if (mysqli_query($db, $query)) {


        $output = 1;

    } else {
        $output = 'Error' . mysqli_error($db) . '<br>' . $query;

    }




    echo $output;
}
?>