<?php
include("../config.php");
session_start();
if (!empty($_POST)) {
    $output = '';
    $message = '';
    $users = mysqli_real_escape_string($db, $_POST["users"]);
    $type = mysqli_real_escape_string($db, $_POST["type"]);
    $small = mysqli_real_escape_string($db, $_POST["small"]);
    $medium = mysqli_real_escape_string($db, $_POST["medium"]);
    $large = mysqli_real_escape_string($db, $_POST["large"]);
    $e_large = mysqli_real_escape_string($db, $_POST["e_large"]);
    $banks = mysqli_real_escape_string($db, $_POST["banks"]);
    $amount = mysqli_real_escape_string($db, $_POST["amount"]);


    $file = rand(1000,100000)."-".$_FILES['images_file']['name'];
    $file_loc = $_FILES['images_file']['tmp_name'];
    $file_size = $_FILES['images_file']['size'];
    //  $file_type = $_FILES['file']['type'];
    $folder="../uploads/";
    move_uploaded_file($file_loc,$folder.$file);
    $f_file = 'uploads/'.$file;

    $Date = date('Y-m-d H:i:s');

    $query = "INSERT INTO uni_order(type_id,size_1,size_2,size_3,size_4,quantity,status,recorddate,userid,image,bank,amount)
    VALUES('$type','$small','$medium','$large','$e_large','','0','$Date','$users','$f_file','$banks','$amount')";
    $message = 'Data Inserted  ';




    if (mysqli_query($db, $query)) {
        // $output .= '<div class="alert alert-light-warning border-0 mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>' . $message . ' !</strong></div>';
        $output = 1;  
        
    }
    else{
        $output = 0;  
        
    }
    echo $output;
}
?>