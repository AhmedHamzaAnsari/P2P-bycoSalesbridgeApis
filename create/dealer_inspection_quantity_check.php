<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $task_id =  $_POST["task_id"];
    $dispenser_id =  $_POST["dispenser_id"];
    $nozle_id =  $_POST["nozle_id"];
    $form_id =  $_POST["form_id"];
    $dealer_id =  $_POST["dealer_id"];
    $result =  $_POST["result"];
    $totalizer =  $_POST["totalizer"];
    $product_id =  $_POST["product_id"];
    $dpt_id =  $_POST["dpt_id"];

    
    
    $date = date('Y-m-d H:i:s');

    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        $query = "INSERT INTO `dealer_inspection_quantity_check`
        (`task_id`,
        `dispenser_id`,
        `nozle_id`,
        `form_id`,
        `dpt_id`,
        `dealer_id`,
        `product_id`,
        `result`,
        `totalizer`,
        `created_at`,
        `created_by`)
        VALUES
        ('$task_id',
        '$dispenser_id',
        '$nozle_id',
        '$form_id',
        '$dpt_id',
        '$dealer_id',
        '$product_id',
        '$result',
        '$totalizer',
        '$date',
        '$user_id'
        );";


        if (mysqli_query($db, $query)) {


            $output = 1;

        } else {
            $output = 'Error' . mysqli_error($db) . '<br>' . $query;

        }
    }



    echo $output;
}
?>