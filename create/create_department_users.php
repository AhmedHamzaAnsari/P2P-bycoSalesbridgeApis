<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['confirm_password']);
    $password_enc = mysqli_real_escape_string($db, $_POST['confirm_password']);
    $encriped = md5($password_enc);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    // $privilege = mysqli_real_escape_string($db,$_POST['privilege']); 
    // $role = mysqli_real_escape_string($db, $_POST['role']);
    $dpt_id = mysqli_real_escape_string($db, $_POST['dpt_id']);
    $dpt_role = mysqli_real_escape_string($db, $_POST['dpt_role']);

    $is_parents = mysqli_real_escape_string($db, $_POST['is_parents']);

    $parent_id = '';

    if($is_parents!='1'){
        $parent_id = $_POST['parent_user'];
    }
    else{
        $parent_id = '';

    }

   
    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {


        $query = "INSERT INTO  users (`name`,`privilege`,`login`, `password`,`usersettings_id`,`status`,`description`,`email`,`telephone`,`subacc_id`,`independent_exist`)
        VALUES ('$name', '$dpt_role', '$email', '$encriped','1','1','$password','$email','$number','$parent_id','1')";



        if (mysqli_query($db, $query)) {
            $main_id = mysqli_insert_id($db);

                echo 1;

            

            // $output = 1;

        } else {
            echo 'Error' . mysqli_error($db) . '<br>' . $query;

        }
    }




    // echo $output;
}
?>