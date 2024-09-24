<?php
//fetch.php  
include("../old_byco_config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$customername = $_GET["customername"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM gotrack.bycotrip where customername='$customername' order by id desc;";

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