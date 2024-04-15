<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$is_role = $_GET["is_role"];
$user_id = $_GET["user_id"];

if ($pass != '') {
    if ($pass == $access_key) {
        if ($is_role != 0) {

            $sql_query1 = "SELECT * FROM dealers ;";

            $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

            $thread = array();
            while ($user = $result1->fetch_assoc()) {
                $thread[] = $user;
            }
            echo json_encode($thread);
        } else {
            $sql_query1 = "SELECT * FROM users where id = '$user_id' order by id desc ;";

            $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

            $thread = array();
            while ($user = $result1->fetch_assoc()) {
                $dealer_ids = $user['dealer_ids'];
                // $array = explode(", ", $dealer_ids);
                // echo json_encode($array);
                if($dealer_ids!=''){
                    $sql_query2 = "SELECT * FROM dealers where id IN($dealer_ids);";
    
                    $result2 = $db->query($sql_query2) or die("Error :" . mysqli_error($db));
    
                    $thread = array();
                    while ($user = $result2->fetch_assoc()) {
                        $thread[] = $user;
                    }
                    echo json_encode($thread);
                    
                }
                else{
                    echo json_encode($thread);

                }


                // Output the resulting array
                // print_r($array);
            }
        }

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>