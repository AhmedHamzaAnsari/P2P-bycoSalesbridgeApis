<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $all_dpt = mysqli_real_escape_string($db, $_POST['all_dpt']);
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $is_parents = mysqli_real_escape_string($db, $_POST['is_parents']);

    $date = date('Y-m-d H:i:s');

    $is_parent_val = 0;
    $parent_id = 0;
    if($is_parents=='Yes'){
        $is_parent_val = 1;
        $parent_id = 0;
    }
    else{
        
        $is_parent_val = 0;
        $parent_id = $_POST['parents_id'];
    }

  
    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {


        $query = "INSERT INTO `department_users`
        (`department_id`,
        `parent_id`,
        `name`,
        `is_parent`,
        `created_at`,
        `created_by`)
        VALUES
        ('$all_dpt',
        '$parent_id',
        '$name',
        '$is_parent_val',
        '$date',
        '$user_id');";



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