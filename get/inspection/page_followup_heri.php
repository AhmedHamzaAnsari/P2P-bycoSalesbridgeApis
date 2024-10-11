<?php
//fetch.php  
include("../../config.php");
error_reporting(0);
$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    $from = $_GET["from"];
    $to = $_GET["to"];
    $pre = $_GET["pre"];
    if ($pass == $access_key) {
        $datetimes = date('Y-m-d H:i:s');
        $thread = array();
        $dpts = '';
        if ($pre != 'Admin') {
            $dpt_id = $_GET["department_id"];
            $dpts = "SELECT * FROM department WHERE id='$dpt_id'";
        } else {
            $dpts = "SELECT * FROM department";
        }

        $resultdpts = $db->query($dpts) or die("Error: " . mysqli_error($db));

        while ($userresultdpts = $resultdpts->fetch_assoc()) {
            $dpt_id = $userresultdpts['id'];

            $sql_query2 = "SELECT df.*, ifs.name AS form_name, dt.name dpt_name 
                           FROM department_forms AS df
                           JOIN inspection_form AS ifs ON ifs.id = df.form_id
                           JOIN department AS dt ON dt.id = df.department_id
                           WHERE df.department_id = $dpt_id";

            $result2 = $db->query($sql_query2) or die("Error: " . mysqli_error($db));

            while ($user2 = $result2->fetch_assoc()) {
                $form_name = $user2['form_name'];
                $form_id = $user2['form_id'];
                $dpt_name = $user2['dpt_name'];

                $survey_form_sql = "SELECT * FROM follow_ups 
                                    WHERE form_name='$form_name' 
                                    AND created_at >= '$from' 
                                    AND created_at <= '$to' 
                                    AND dpt_id = '$dpt_id'";

                $survey_form_result = $db->query($survey_form_sql) or die("Error: " . mysqli_error($db));

                while ($user_f = $survey_form_result->fetch_assoc()) {
                    $idds = $user_f['id'];
                    $cat_table = $user_f['cat_table'];
                    $ques_table = $user_f['ques_table'];

                    $survey_sql = "SELECT 
                                    fu.*, dt.name AS dpt_name, inf.name AS fm_name, 
                                    dtu.name AS follow_dpt, it.type AS task_type, 
                                    it.time AS tas_time, it.description AS task_des, 
                                    it.form_json, us.name AS inspector_name, 
                                    dl.name AS dealers_name, sc.name AS cat_name, 
                                    sq.question AS ques_name, sq.duration AS hours_duration, 
                                    dl.region, dl.province, dl.city, dl.actual_depot, 
                                    dl.terr, dl.cat_1, dl.cat_2, 
                                    CASE 
                                        WHEN fu.status = 0 THEN 'Pending'
                                        ELSE 'Complete'
                                    END AS status_val,
                                    (SELECT count(*) as chat_counts FROM bycobridge.followup_notification where followup_id=$idds)as chat_counts
                                    FROM follow_ups AS fu
                                    JOIN department AS dt ON dt.id = fu.dpt_id
                                    JOIN inspection_form AS inf ON inf.id = fu.form_id
                                    JOIN department AS dtu ON dtu.id = fu.dpt_id
                                    JOIN inspector_task AS it ON it.id = fu.task_id
                                    JOIN users AS us ON us.id = it.user_id
                                    JOIN dealers AS dl ON dl.id = it.dealer_id
                                    JOIN $cat_table AS sc ON sc.id = fu.category_id
                                    JOIN $ques_table AS sq ON sq.id = fu.question_id
                                    WHERE fu.id = $idds 
                                    AND fu.created_at >= '$from' 
                                    AND fu.created_at <= '$to'";

                    $survey_result = $db->query($survey_sql) or die("Error: " . mysqli_error($db));

                    while ($user = $survey_result->fetch_assoc()) {
                        $hours_duration = $user['hours_duration'];
                        $created_at = $user['created_at'];
                        $dptment_id = $user['dpt_id'];

                        $diff = diferr($created_at, $datetimes);

                        $sql_dpt_heri = "SELECT * FROM department_users 
                                         WHERE department_id = $dptment_id 
                                         ORDER BY id DESC";
                        $sql_dpt_heri_result = $db->query($sql_dpt_heri) or die("Error: " . mysqli_error($db));

                        $resultLength = mysqli_num_rows($sql_dpt_heri_result);
                        $dynamic_val_end = $hours_duration * $resultLength;
                        $dynamic_val = $hours_duration;
                        $index = 0;
                        $resultArray = array();

                        while ($user_sql_dpt = $sql_dpt_heri_result->fetch_assoc()) {
                            $resultArray[] = $user_sql_dpt;
                            $parent_id = $user_sql_dpt['parent_id'];
                            $name = $user_sql_dpt['name'];

                            if ($dynamic_val >= $diff) {
                                break;
                            } elseif ($diff >= $dynamic_val_end) {
                                $index = $resultLength - 1;
                                break;
                            } else {
                                $index++;
                                $dynamic_val += $hours_duration;
                            }
                        }
                        $user['waiting'] = 'Waiting For All ' . $resultArray[$index]['name'];
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

function diferr($d1, $d2)
{
    $datetime1 = new DateTime($d1);
    $datetime2 = new DateTime($d2);

    $interval = $datetime1->diff($datetime2);
    $hours = $interval->h + ($interval->days * 24);

    return $hours;
}
?>
