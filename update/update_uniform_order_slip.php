<?php
include("../config.php");
session_start();
if (isset($_POST)) {


    // $user_id = $_POST['user_id'];
    $order_id = $_POST['order_id'];


    $file = rand(1000,100000)."-".$_FILES['images_file']['name'];
    $file_loc = $_FILES['images_file']['tmp_name'];
    $file_size = $_FILES['images_file']['size'];
    //  $file_type = $_FILES['file']['type'];
    $folder="../uploads/";
    move_uploaded_file($file_loc,$folder.$file);
    $f_file = 'uploads/'.$file;

    $datetime = date('Y-m-d H:i:s');
    $val = '';

    

    $query = "UPDATE `uni_order` SET
    `image`='$f_file'
     WHERE id=$order_id";


    if (mysqli_query($db, $query)) {

        $output = 1;


    } else {
        $output = 'Error' . mysqli_error($db) . '<br>' . $query;

    }




    echo $output;
}
?>