<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $task_id =  $_POST["task_id"];
    $form_id =  $_POST["form_id"];
    $dpt_id =  $_POST["dpt_id"];
    $dealer_id =  $_POST["dealer_id"];
    $product_id =  $_POST["product_id"];

    $ogra_price =  $_POST["ogra_price"];
    $pump_price =  $_POST["pump_price"];
    $variance =  $_POST["variance"];

    
    
    $date = date('Y-m-d H:i:s');

    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        $query = "INSERT INTO `dealer_inspection_price_check`
        (`task_id`,
        `form_id`,
        `dpt_id`,
        `dealer_id`,
        `product_id`,
        `ogra_price`,
        `pump_price`,
        `variance`,
        `created_at`,
        `created_by`)
        VALUES
        ('$task_id',
        '$form_id',
        '$dpt_id',
        '$dealer_id',
        '$product_id',
        '$ogra_price',
        '$pump_price',
        '$variance',
        '$date',
        '$user_id');";


        if (mysqli_query($db, $query)) {


            $output = 1;

        } else {
            $output = 'Error' . mysqli_error($db) . '<br>' . $query;

        }
    }



    echo $output;
}
?>