<?php
//fetch.php  
include("../../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {

        $thread = array();
        $dpts = "SELECT * FROM department";

        $resultdpts = $db->query($dpts) or die("Error :" . mysqli_error($db));

        while ($userresultdpts = $resultdpts->fetch_assoc()) {
            $dpt_id = $userresultdpts['id'];

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
    
    
                $survey_form_sql = "SELECT * FROM follow_ups where form_name='$form_name'";
    
                $survey_form_result = $db->query($survey_form_sql) or die("Error :" . mysqli_error($db));
    
                while ($user_f = $survey_form_result->fetch_assoc()) {
                    $idds = $user_f['id'];
    
                    $cat_table = $user_f['cat_table'];
                    $ques_table = $user_f['ques_table'];
    
    
    
                    $survey_sql = "SELECT 
                    fu.*,
                    dt.name as dpt_name,
                    inf.name as fm_name,
                    dtu.name follow_dpt,
                    it.type as task_type,
                    it.time as tas_time,
                    it.description as task_des,
                    it.form_json,
                    us.name as inspector_name,
                    dl.name as dealers_name ,
                    sc.name as cat_name,
                    sq.question as ques_name,
                    sq.duration as hours_duration,

                     CASE 
                            WHEN fu.status = 0 THEN 'Pending'
                            ELSE 'Complete'
                        END AS status_val
                    FROM follow_ups as fu
                    join department as dt on dt.id=fu.dpt_id
                    join inspection_form as inf on inf.id=fu.form_id
                    join department as dtu on dtu.id=fu.dpt_users
                    join inspector_task as it on it.id=fu.task_id
                    join users as us on us.id=it.user_id
                    join dealers as dl on dl.id=it.dealer_id
                    join $cat_table as sc on sc.id=fu.category_id
                    join $ques_table as sq on sq.id=fu.question_id
                    where fu.id=$idds;";
    
                    $survey_result = $db->query($survey_sql) or die("Error :" . mysqli_error($db));
    
                    while ($user = $survey_result->fetch_assoc()) {
                        $thread[] = $user;
                    }
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