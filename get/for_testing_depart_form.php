<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    $id = $_GET["id"];
    if ($pass == $access_key) {
        $data = getting($id, $db);

        echo $data;

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}

function getting($id, $db)
{
    $sql_query1 = "SELECT us.*,du.department_id,du.parent_id,du.is_parent,du.name as pre FROM users as us 
    join department_users as du on du.id=us.privilege
    where us.id='$id'";

    $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

    $thread = array();
    while ($user = $result1->fetch_assoc()) {
        // $thread[] = $user;
        $dpt_id = $user['department_id'];

        $sql_query2 = "SELECT df.*,dt.name as department_name,ip.name AS form_name FROM department_forms as df 
            join department as dt on dt.id=df.department_id
            join inspection_form as ip on ip.id=df.form_id where df.department_id='$dpt_id'";

        $result2 = $db->query($sql_query2) or die("Error :" . mysqli_error($db));

        $forms = array();

        while ($user2 = $result2->fetch_assoc()) {
            // $thread[] = $user;
            $form_id = $user2['form_id'];
            $form_name = $user2['form_name'];

            $forms[] = array(
                "form_id" => $form_id,
                "form_name" => $form_name,
                "status" => 0
            );


        }
        return json_encode($forms);


    }
}


?>