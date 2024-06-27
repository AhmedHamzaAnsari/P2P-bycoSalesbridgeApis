<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $task_id = mysqli_real_escape_string($db, $_POST["task_id"]);
    $dealer_id = mysqli_real_escape_string($db, $_POST["dealer_id"]);
    $tm_id = mysqli_real_escape_string($db, $_POST["tm_id"]);
    $report_name = mysqli_real_escape_string($db, $_POST["report_name"]);
    $form_id = mysqli_real_escape_string($db, $_POST["form_id"]);
    $form_name = mysqli_real_escape_string($db, $_POST["form_name"]);

    $date = date('Y-m-d H:i:s');

    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        $query = "INSERT INTO `reports_emailers`
        (`task_id`,
        `dealer_id`,
        `tm_id`,
        `report_name`,
        `form_id`,
        `form_name`,
        `created_at`)
        VALUES
        ('$task_id',
        '$dealer_id',
        '$tm_id',
        '$report_name',
        '$form_id',
        '$form_name',
        '$date');";


        if (mysqli_query($db, $query)) {


            $output = 1;

        } else {
            $output = 'Error' . mysqli_error($db) . '<br>' . $query;

        }
    }



    echo $output;
}
?>