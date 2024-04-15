<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$department_id = $_GET['id'];
if ($pass != '') {
    if ($pass == $access_key) {


        $sql = "SELECT * FROM department_users where id='$department_id'";

        // echo $sql;

        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result);

        $id = $row['id'];
        $name = $row['name'];
        $is_parent = $row['is_parent'];
        $parent_id = $row['parent_id'];
        $thread = array();
        if($is_parent!="1"){

            $sql_query1 = "SELECT * FROM users where privilege=$parent_id";
    
            $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));
    
            
            while ($user = $result1->fetch_assoc()) {
                $thread[] = $user;
            }
            $dealerProductCounts = [
                   
                "is_parent" => $is_parent,
                "name" => $name,
                "users" => $thread,
            ];
            $data[] = $dealerProductCounts;

            echo json_encode($data);
            
        }
        else{
            // $dealerProductCounts = [
                   
            //     "is_parent" => $is_parent,
            //     "name" => $name,
            //     "users" => '',
            // ];
            // $data[] = $dealerProductCounts;

            // echo json_encode($data);

            $sql_query1 = "SELECT * FROM users where privilege=$id";
    
            $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));
    
            
            while ($user = $result1->fetch_assoc()) {
                $thread[] = $user;
            }
            $dealerProductCounts = [
                   
                "is_parent" => $is_parent,
                "name" => $name,
                "users" => $thread,
            ];
            $data[] = $dealerProductCounts;

            echo json_encode($data);

        }


    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>