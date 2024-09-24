<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $dealer_id = mysqli_real_escape_string($db, $_POST["dealer_id"]);


    $object_part = mysqli_real_escape_string($db, $_POST["object_part"]);
    $damage_overview = mysqli_real_escape_string($db, $_POST["damage_overview"]);
    $damage = mysqli_real_escape_string($db, $_POST["damage"]);
    $text = mysqli_real_escape_string($db, $_POST["text"]);
    $cause_text = mysqli_real_escape_string($db, $_POST["cause_text"]);

    $date = date('Y-m-d H:i:s');

    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    //  $file_type = $_FILES['file']['type'];
    $folder = "../uploads/";
    move_uploaded_file($file_loc, $folder . $file);
    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        $query = "INSERT INTO `dealers_complaint`
        (`object_part_id`,
        `damage_overview_id`,
        `damage`,
        `text`,
        `cause_text`,
        `file`,
        `created_at`,
        `created_by`)
        VALUES
        ('$object_part',
        '$damage_overview',
        '$damage',
        '$text',
        '$cause_text',
        '$file',
        '$date',
        '$dealer_id');";


        if (mysqli_query($db, $query)) {


            $output = 1;

        } else {
            $output = 'Error' . mysqli_error($db) . '<br>' . $query;

        }
    }



    echo $output;
}
?>