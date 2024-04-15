<?php
include("../../config.php");
session_start();
if (isset($_GET)) {

    $sapNo = $_GET["sapNo"];
    $sapTime = $_GET['sapTime'];
    $vehicle = $_GET["vehicle"];
    $depo = $_GET["depo"];
    $customer = $_GET["customer"];
    $productDetail = $_GET["productDetail"];


    $date = date('Y-m-d H:i:s');

    // echo 'HAmza';
   

        $query = "INSERT INTO `puma_sap_data`
        (`sap_no`,
        `sap_time`,
        `vehicle`,
        `depo`,
        `customer`,
        `product_detail`,
        `created_at`)
        VALUES
        ('$sapNo',
        '$sapTime',
        '$vehicle',
        '$depo',
        '$customer',
        '$productDetail',
        '$date');";


        if (mysqli_query($db,$query)) {


            $output = 'Record Created';

        } else {
            $output = 'Error' . mysqli_error($db) . '<br>' . $query;

        }
    



    echo $output;
}
?>