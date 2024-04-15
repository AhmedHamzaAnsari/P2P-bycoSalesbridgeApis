<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$pre = $_GET["pre"];
$id = $_GET["user_id"];

if ($pass != '') {
    if ($pass == $access_key) {

        if($pre == 'ZM'){

            $sql_query1 = "SELECT * FROM dealers where zm=$id order by id desc";
        }
        elseif($pre == 'TM'){
            
            $sql_query1 = "SELECT * FROM dealers where tm=$id order by id desc";
        }
        elseif($pre == 'ASM'){
            $sql_query1 = "SELECT * FROM dealers where asm=$id order by id desc";

        }else{

            $sql_query1 = "SELECT * FROM dealers where privilege='Dealer' order by id desc ;";
        }


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