<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$id=$_GET["dealer_id"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT *,pp.id as product_id FROM dealers_products as p
        join all_products as pp on p.name=pp.id where p.dealer_id=$id;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $thread[] = $user;
        }
        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}

?>