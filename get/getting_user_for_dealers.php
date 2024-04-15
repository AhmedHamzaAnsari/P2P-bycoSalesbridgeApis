<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$role_id = $_GET['role_id'];
$department_id = $_GET['dpt'];
if ($pass != '') {
    if ($pass == $access_key) {


        $sql = "SELECT * FROM department_users where department_id='$department_id' and id<=$role_id";

        // echo $sql;



        $result = $db->query($sql) or die("Error :" . mysqli_error($db));

            $role_arr = array();
        
        while ($role = $result->fetch_assoc()) {
            $role_arr[] = $role;


            // $id = $role['id'];
            // $name = $role['name'];
            // $is_parent = $role['is_parent'];
            // $parent_id = $role['parent_id'];
            // $thread = array();
            // if ($is_parent != "1") {

            //     $sql_query1 = "SELECT * FROM users where privilege=$parent_id";

            //     $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));


            //     while ($user = $result1->fetch_assoc()) {
            //         $thread[] = $user;
            //     }
            //     $dealerProductCounts = [

            //         "is_parent" => $is_parent,
            //         "name" => $name,
            //         "users" => $thread,
            //     ];
            //     $data[] = $dealerProductCounts;

            //     echo json_encode($data);

            // } else {
            //     $dealerProductCounts = [

            //         "is_parent" => $is_parent,
            //         "name" => $name,
            //         "users" => '',
            //     ];
            //     $data[] = $dealerProductCounts;

            //     echo json_encode($data);

            // }
        }
        echo json_encode($role_arr);


    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>