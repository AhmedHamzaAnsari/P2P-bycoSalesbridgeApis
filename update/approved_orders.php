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
        $val = 'Approved';

    } elseif ($approved_order_status == 2) {
        $val = 'Placed (Hold)';

    } elseif ($approved_order_status == 3) {
        $val = 'Placed (Released)';

    }

    $query = "UPDATE `order_main` SET 
    `status`='$approved_order_status',
    `status_value`='$val',
    `order_no`='$orderno',
    `comment`='$approved_order_description',
    `approved_time`='$datetime' WHERE id=$order_approval";


    if (mysqli_query($db, $query)) {


        $log = "INSERT INTO `order_detail_log`
        (`order_id`,
        `status`,
        `status_value`,
        `description`,
        `created_at`,
        `created_by`)
        VALUES
        ('$order_approval',
        '$approved_order_status',
        '$val',
        '$approved_order_description',
        '$datetime',
        '$user_id');";
        if (mysqli_query($db, $log)) {
            $output = 1;

        } else {
            $output = 'Error' . mysqli_error($db) . '<br>' . $log;

        }

    } else {
        $output = 'Error' . mysqli_error($db) . '<br>' . $query;

    }




    echo $output;
}
?>