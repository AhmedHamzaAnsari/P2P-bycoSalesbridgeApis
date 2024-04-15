<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM users where dealer_ids!='' order by id desc;";
        // left join department_users as dup on dup.id=du.parent_id order by du.id asc;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $name = $user['name'];
            $dealers = $user['dealer_ids'];

            $sql_query2 = "SELECT GROUP_CONCAT(name SEPARATOR ', ') as dealer_name FROM dealers where id IN($dealers);";
            // left join department_users as dup on dup.id=du.parent_id order by du.id asc;";

            $result2 = $db->query($sql_query2) or die("Error :" . mysqli_error());

           
            while ($user2 = $result2->fetch_assoc()) {
                $dealer_name = $user2['dealer_name'];
                $thread[] = array(
                    "name"=>$name,
                    'dealers'=>$dealer_name
                );




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