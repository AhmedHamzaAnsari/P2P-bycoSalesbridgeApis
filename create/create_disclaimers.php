<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $subject = mysqli_real_escape_string($db, $_POST["subject"]);

    $date = date('Y-m-d H:i:s');


    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        $query = "INSERT INTO `disclaimers`
        (`disclaimer`,
        `created_at`,
        `created_by`)
        VALUES
        ('$subject',
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