<?php
include ("../config.php");
session_start();
if (isset($_POST)) {


    $employee_id = $_POST['employee_id'];
    $status = $_POST['status'];
   


    $query = "UPDATE uni_order SET status='$status' WHERE id='$employee_id';";


    if (mysqli_query($db, $query)) {

        $output = 1;
    } else {
        $output = 'Error' . mysqli_error($db) . '<br>' . $query;

    }




    echo $output;
}
?>