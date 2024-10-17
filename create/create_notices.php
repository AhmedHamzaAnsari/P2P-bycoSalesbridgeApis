<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $subject = mysqli_real_escape_string($db, $_POST["subject"]);
    $message = mysqli_real_escape_string($db, $_POST["message"]);
    $link = mysqli_real_escape_string($db, $_POST["link"]);

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

        $query = "INSERT INTO `notice_board`
        (`subject`,
        `message`,
        `link`,
        `file`,
        `created_at`,
        `created_by`)
        VALUES
        ('$subject',
        '$message',
        '$link',
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