<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    // $id = $_GET["id"];
    if ($pass == $access_key) {
        $sql_query1 = "SELECT distinct(name) as id,CASE 
        WHEN name = 'PMG' THEN 'Gasoline'
        WHEN name = 'HSD' THEN 'Diesel'
        WHEN name = 'Gasoline 95' THEN 'Gasoline 95'
    END AS name FROM bycobridge.all_products;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $thread[] = $user;
        }
        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} 
else 
{
    echo 'Key is Required';
}


?>