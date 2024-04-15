<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    $dpt_id = $_GET["dpt_id"];
    $dealers = $_GET["dealers"];
    if ($pass == $access_key) {

        $thread = array();
      

            $sql_query2 = "SELECT df.*,ifs.name as form_name,dt.name dpt_name FROM department_forms as df
            join inspection_form as ifs on ifs.id=df.form_id
            join department as dt on dt.id=df.department_id
            where df.department_id=$dpt_id";

            $result2 = $db->query($sql_query2) or die("Error :" . mysqli_error($db));

            while ($user2 = $result2->fetch_assoc()) {
                // $thread[] = $user;

                $form_name = $user2['form_name'];
                $form_id = $user2['form_id'];
                $dpt_name = $user2['dpt_name'];


                $survey_form_sql = "SELECT fu.*,it.dealer_id FROM follow_ups as fu
                join inspector_task as it on it.id=fu.task_id

                where fu.form_name='$form_name' and fu.status=0 and it.dealer_id IN($dealers)";

                $survey_form_result = $db->query($survey_form_sql) or die("Error :" . mysqli_error($db));

                while ($user_f = $survey_form_result->fetch_assoc()) {
                    $idds = $user_f['id'];

                    $cat_table = $user_f['cat_table'];
                    $ques_table = $user_f['ques_table'];



                    $survey_sql = "SELECT fl.*,dt.name as dpt_name,sc.name as cat_name,sq.question as ques_name FROM follow_ups as fl 
                    join department as dt on dt.id=fl.dpt_users
                    join $cat_table as sc on sc.id=fl.category_id
                    join $ques_table as sq on sq.id=fl.question_id
                    join inspector_task as it on it.id=fl.task_id
                    where fl.id=$idds and fl.status=0;";

                    $survey_result = $db->query($survey_sql) or die("Error :" . mysqli_error($db));

                    while ($user = $survey_result->fetch_assoc()) {
                        $thread[] = $user;
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