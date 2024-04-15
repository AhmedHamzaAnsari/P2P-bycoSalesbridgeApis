<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$id=$_GET['id'];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT df.*,dt.name as department_name,GROUP_CONCAT(ip.name SEPARATOR ', ') AS form_name FROM department_forms as df 
        join department as dt on dt.id=df.department_id
        join inspection_form as ip on ip.id=df.form_id group by df.department_id";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

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
