<?php
//fetch.php  
include ("../../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {

        // $dealer_id = $_GET['dealer_id'];
        // $sql = "SELECT * FROM bycobridge.dealers where id=$dealer_id";

        // // echo $sql;

        // $result = mysqli_query($db, $sql);
        // $row = mysqli_fetch_array($result);
        // $is_check_in = $row['is_check_in'];

        // if($is_check_in!=0){
        //     $v_lat = floatval($_GET['i_lat']);
        //     $v_lng = floatval($_GET['i_lng']);
    
        //     $c_lat = floatval($_GET['d_lat']);
        //     $c_lng = floatval($_GET['d_lng']);
        //     $km = 0.155;
    
        //     $ky = 40000 / 360;
        //     $kx = cos(pi() * $c_lat / 180.0) * $ky;
        //     $dx = abs($c_lng - $v_lng) * $kx;
        //     $dy = abs($c_lat - $v_lat) * $ky;
    
    
    
    
        //     if (sqrt(($dx * $dx) + ($dy * $dy)) <= $km == true) {
    
    
        //         echo 'IN';
        //     } else {
    
        //         echo 'Not IN ';
    
        //     }

        // }else{
        //     echo 'With-Out Check-In';
        // }
        echo 'IN';

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}

?>