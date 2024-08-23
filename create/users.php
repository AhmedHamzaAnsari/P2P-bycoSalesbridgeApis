<?php
include ("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['confirm_password']);
    $password_enc = mysqli_real_escape_string($db, $_POST['confirm_password']);
    $encriped = md5($password_enc);
    $number = mysqli_real_escape_string($db, $_POST['number']);

    $regions = $_POST['regions'];
    
    $myString = implode(", ", $regions);



    // echo 'HAmza';
    if ($_POST["row_id"] != '') {
        
        $id = $_POST["row_id"];

        $query = "UPDATE users SET name='$name',
        password='$encriped',
        description='$password',
        telephone='$number',
        email='$email',
        region='$myString'
        WHERE id='$id'";



        if (mysqli_query($db, $query)) {
            echo 1;

            // $output = 1;

        } else {
            echo 'Error' . mysqli_error($db) . '<br>' . $query;

        }

    } else {


        $query = "INSERT INTO  users (`name`,`privilege`,`login`, `password`,`usersettings_id`,`status`,`description`,`email`,`telephone`,`region`)
        VALUES ('$name', 'NSM', '$email', '$encriped','1','1','$password','$email','$number','$myString')";



        if (mysqli_query($db, $query)) {
            echo 1;

            // $output = 1;

        } else {
            echo 'Error' . mysqli_error($db) . '<br>' . $query;

        }
    }




    // echo $output;
}
?>