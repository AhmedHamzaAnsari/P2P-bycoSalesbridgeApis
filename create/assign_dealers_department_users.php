<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $dpt_id = mysqli_real_escape_string($db, $_POST['dpt_id']);
    $dpt_role = mysqli_real_escape_string($db, $_POST['dpt_role']);
    $parent_user = mysqli_real_escape_string($db, $_POST['parent_user']);
    $depots = $_POST['depots'];
    $is_parents  = mysqli_real_escape_string($db, $_POST['is_parents']);
    
    $myString = implode(", ", $depots);
    
    $update_user_id = '';
    
    $parent_id = '';
    
    if($is_parents!='1'){
        $child_users = mysqli_real_escape_string($db, $_POST['child_users']);
        $update_user_id = $child_users;

    }
    else{
        $update_user_id = $parent_user;

    }

   
    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {


        $query = "UPDATE `users`
        SET
        `dealer_ids` = '$myString'
        WHERE `id` = '$update_user_id'";



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