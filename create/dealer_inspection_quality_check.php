<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $task_id =  $_POST["task_id"];
    $form_id =  $_POST["form_id"];
    $dealer_id =  $_POST["dealer_id"];
    $response =  $_POST["response"];
    $dpt_id =  $_POST["dpt_id"];
    $description =  $_POST["description"];

    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    //  $file_type = $_FILES['file']['type'];
    $folder = "../uploads/";
    move_uploaded_file($file_loc, $folder . $file);
    
    $date = date('Y-m-d H:i:s');

    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        $query = "INSERT INTO `dealer_inspection_quality_check`
        (`task_id`,
        `form_id`,
        `dealer_id`,
        `response`,
        `files`,
        `dpt_id`,
        `description`,
        `created_at`,
        `created_by`)
        VALUES
        ('$task_id',
        '$form_id',
        '$dealer_id',
        '$response',
        '$file',
        '$dpt_id',
        '$description',
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