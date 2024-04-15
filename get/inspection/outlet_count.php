<?php
//fetch.php  
include("../../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {
        $id = $_GET["id"];
        $pre = $_GET["pre"];

        // if($pre == 'ZM'){

        //     $sql_query1 = "SELECT * FROM dealers where zm=$id";
        // }
        // elseif($pre == 'TM'){
            
        //     $sql_query1 = "SELECT * FROM dealers where tm=$id";
        // }
        // else{
        //     $sql_query1 = "SELECT * FROM dealers where asm=$id";

        // }


        // $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        // $thread = array();
        // while ($user = $result1->fetch_assoc()) {
        //     $thread[] = $user;
        // }
        // echo json_encode($thread);
        $sql_query1 = "SELECT * FROM users where dealer_ids!='' and id='$id' order by id desc;";
        // left join department_users as dup on dup.id=du.parent_id order by du.id asc;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $name = $user['name'];
            $dealers = $user['dealer_ids'];

            $sql_query2 = "SELECT * FROM dealers where id IN($dealers);";
            // left join department_users as dup on dup.id=du.parent_id order by du.id asc;";

            $result2 = $db->query($sql_query2) or die("Error :" . mysqli_error());

           
            while ($user2 = $result2->fetch_assoc()) {
                $thread[] = $user2;




            }
        }
        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>