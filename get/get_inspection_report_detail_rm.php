<?php
// fetch.php  
include("../config.php");

$access_key = '03201232927';

$pass = $_GET["key"];
$pre = $_GET["pre"];
$rm_id = $_GET["user_id"];
$from = $_GET["from"];
$to = $_GET["to"];

if (!empty($pass)) {
    if ($pass === $access_key) {
        $thread = array();

        $sql_tms = "SELECT us.*,du.name as pre_name,dt.name as dpt_name,rm.name as rm_name FROM bycobridge.department_users as du 
        join users as us on us.privilege=du.id
        join department as dt on dt.id=du.department_id
        join users as rm on rm.id=us.subacc_id
        where dt.name='Retail Network' and du.name='TM' and us.subacc_id IN($rm_id) order by us.subacc_id";

        $result_tm = $db->query($sql_tms) or die("Error: " . $db->error);

        while ($user_tm = $result_tm->fetch_assoc()) {
            $inspection_report = 0;
            $ehs_report = 0;
            $recon_report = 0;
            $profitability_report = 0;
            $decant_report = 0;
            $tm_id = $user_tm['id'];
            $tm_name = $user_tm['name'];
            $rm_name = $user_tm['rm_name'];
            $dealer_ids = $user_tm['dealer_ids'];

            $sql_query1 = "SELECT * FROM bycobridge.dealers 
                           WHERE privilege = 'Dealer' AND id IN($dealer_ids) 
                           ORDER BY name ASC";
            $result1 = $db->query($sql_query1) or die("Error: " . $db->error);

            while ($user = $result1->fetch_assoc()) {
                $dealer_id = $user['id'];
                $dealer_name = $user['name'];

                $sql_query2 = "SELECT it.*, us.name as user_name, dd.name as dealer_name, dt.name as dpt_name, du.name as role_name, it.created_at as task_create_time,
                               CASE
                                   WHEN it.status = 0 THEN 'Pending'
                                   WHEN it.status = 1 THEN 'Complete'
                                   WHEN it.status = 2 THEN 'Cancel'
                               END AS current_status, dd.region, dd.province, dd.city, dd.actual_depot, dd.terr, dd.cat_1, dd.cat_2
                               FROM inspector_task as it
                               JOIN dealers as dd ON dd.id = it.dealer_id
                               JOIN users as us ON us.id = it.user_id 
                               JOIN department_users as du ON du.id = us.privilege
                               JOIN department as dt ON dt.id = du.department_id 
                               WHERE it.created_at >= '$from' AND it.created_at <= '$to' AND dd.id = $dealer_id";

                $result2 = $db->query($sql_query2) or die("Error: " . $db->error);

                while ($task = $result2->fetch_assoc()) {
                    $json_form = json_decode($task['form_json'], true);

                    if (json_last_error() === JSON_ERROR_NONE) {
                        foreach ($json_form as $form) {
                            if (isset($form['form_name']) && isset($form['status']) && $form['status'] == 1) {
                                switch ($form['form_name']) {
                                    case 'Inspection':
                                        $inspection_report++;
                                        break;
                                    case 'Stock Reconciliation':
                                        $recon_report++;
                                        break;
                                    case 'Fuel Decantation Audit':
                                        $decant_report++;
                                        break;
                                    case 'Retailer Profitability':
                                        $profitability_report++;
                                        break;
                                    case 'EHS Audit':
                                        $ehs_report++;
                                        break;
                                }
                            }
                        }
                    } else {
                        echo "Error decoding JSON: " . json_last_error_msg();
                    }
                }
            }

            $report_data = array(
                "id" => $tm_id,
                "tm_name" => $tm_name,
                "rm_name" => $rm_name,
                "inspection_count" => $inspection_report,
                "ehs_count" => $ehs_report,
                "recon_count" => $recon_report,
                "profitability_count" => $profitability_report,
                "decant_count" => $decant_report
            );

            $thread[] = $report_data;
        }

        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }
} else {
    echo 'Key is Required';
}
?>
