<?php
//fetch.php  
ini_set('max_execution_time', '0');
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 86400; URL=$url1");
include ("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$date = date('Y-m-d H:i:s');
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT us.id as tm_id,
        us.name as tm_name,
        us.email as tm_email,
        du.name as tm_pre,
        us.playerId as tm_player_id,
        us.dealer_ids
        FROM department_users as du 
        join users as us on us.privilege=du.id
        join department_users as dru on dru.id=du.parent_id
        join users as urm on urm.privilege=dru.id
        join department_users as dnsm on dnsm.id=dru.parent_id
        join users as nsm on nsm.privilege=dnsm.id
        join department_users as dgrm on dgrm.id=dnsm.parent_id
        join users as grm on grm.privilege=dgrm.id
        where  du.name='TM' and urm.id=us.subacc_id and us.playerId!='';";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $all_dealers_id = $user['dealer_ids'];
            $user_id = $user['tm_id'];
            $tm_name = $user['tm_name'];

            echo $tm_name . '<br>';

            // $check_inspection = "SELECT * 
            // FROM dealers as dl
            // WHERE dl.id NOT IN (
            //     SELECT it.dealer_id
            //     FROM inspector_task as it
            //     WHERE MONTH(it.time) = MONTH(CURDATE()) 
            //     AND YEAR(it.time) = YEAR(CURDATE())
            //     AND it.user_id = $user_id
            // ) and dl.id IN($all_dealers_id)";

            $check_inspection = "SELECT 
            SUM(CASE 
                    WHEN dl.id IN (
                        SELECT it.dealer_id
                        FROM inspector_task AS it
                        WHERE MONTH(it.time) = MONTH(CURDATE()) 
                        AND YEAR(it.time) = YEAR(CURDATE())
                        AND it.user_id = $user_id
                    ) THEN 1 
                    ELSE 0 
                END) AS cpc_created,
            SUM(CASE 
                    WHEN dl.id NOT IN (
                        SELECT it.dealer_id
                        FROM inspector_task AS it
                        WHERE MONTH(it.time) = MONTH(CURDATE()) 
                        AND YEAR(it.time) = YEAR(CURDATE())
                        AND it.user_id = $user_id
                    ) THEN 1 
                    ELSE 0 
                END) AS cpc_not_created
        FROM dealers AS dl
        WHERE dl.id IN ($all_dealers_id);";


            $result_check = $db->query($check_inspection) or die("Error :" . mysqli_error($db));

            while ($checks = $result_check->fetch_assoc()) {

                $cpc_created = $checks['cpc_created'];
                $cpc_not_created = $checks['cpc_not_created'];
                $current_date = date('F-y'); // Outputs something like "June-24" depending on the current date
                echo $current_date;

                $notification_msg = 'Hello ' . $tm_name . ' You have created only ' . $cpc_created . ' CPC(s). You still need to create ' . $cpc_not_created . ' more Visit(s) of the month of '.$current_date.'.';
                echo $notification_msg . '<br>';
                $query = "INSERT INTO `push_notifications`
                (`user_id`,
                `header`,
                `message`,
                `send_by`,
                `created_at`,
                `created_by`)
                VALUES
                ('$user_id',
                'CPC Action Required',
                '$notification_msg',
                '$user_id',
                '$date',
                '1');";


                if (mysqli_query($db, $query)) {


                    $output = 1;

                } else {
                    $output = 'Error' . mysqli_error($db) . '<br>' . $query;

                }


            }
        }

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}

echo "Last Run " . date('Y-m-d H:i:s');
?>