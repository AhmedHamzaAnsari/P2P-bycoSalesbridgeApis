<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $dealer_id = $_POST['dealer_id'];
    $file_name = mysqli_real_escape_string($db, $_POST["file_name"]);
    $date = date('Y-m-d H:i:s');

    $file = rand(1000, 100000) . "-" . $_FILES['site_file']['name'];
    $file_loc = $_FILES['site_file']['tmp_name'];
    $file_size = $_FILES['site_file']['size'];
    //  $file_type = $_FILES['file']['type'];
    $folder = "../uploads/";
    move_uploaded_file($file_loc, $folder . $file);

    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        $query = "INSERT INTO `bycobridge`.`dealers_documents`
        (`name`,
        `dealer_id`,
        `file`,
        `created_at`,
        `created_by`)
        VALUES
        ('$file_name',
        '$dealer_id',
        '$file',
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