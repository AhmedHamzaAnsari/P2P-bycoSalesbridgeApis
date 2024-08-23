<?php
//fetch.php  
include ("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$pre = $_GET["pre"];
$id = $_GET["user_id"];

if ($pass != '') {
    if ($pass == $access_key) {
        $thread = array();
        if ($pre == 'Admin' || $pre=='NSM' || $pre=='GM') {

            
            $sql_query1 = "SELECT * FROM dealers where privilege='Dealer' order by id desc ;";
            $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());


            while ($user = $result1->fetch_assoc()) {
                $thread[] = $user;
            }
        } else {

            $sql_query1 = "SELECT * FROM users where dealer_ids!='' and id='$id' order by id desc;";

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
        }



        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>