<?php
include ("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];

    $users = $_POST["users"];

    $headers = mysqli_real_escape_string($db, $_POST["headers"]);
    $notifications = mysqli_real_escape_string($db, $_POST["notifications"]);
    $userData = count($_POST["users"]);
    $date = date('Y-m-d H:i:s');

    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        for ($i = 0; $i < $userData; $i++) {

            $send_by = $_POST['users'][$i];

            $query = "INSERT INTO `push_notifications`
            (`user_id`,
            `header`,
            `message`,
            `send_by`,
            `created_at`,
            `created_by`)
            VALUES
            ('$send_by',
            '$headers',
            '$notifications',
            '$send_by',
            '$date',
            '$user_id');";
    
    
            if (mysqli_query($db, $query)) {
    
    
                $output = 1;
    
            } else {
                $output = 'Error' . mysqli_error($db) . '<br>' . $query;
    
            }
        }

    }



    echo $output;
}
?>