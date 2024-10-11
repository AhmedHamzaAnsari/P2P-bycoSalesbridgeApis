<?php
include ("../config.php");
session_start();
if (isset($_POST)) {


    $employee_id = $_POST['uni_order_id'];
    $vendors = $_POST['vendors'];
   


    $query = "UPDATE uni_order SET vendor='$vendors' WHERE id='$employee_id';";


    if (mysqli_query($db, $query)) {

        $output = 1;
    } else {
        $output = 'Error' . mysqli_error($db) . '<br>' . $query;

    }




    echo $output;
}
?>