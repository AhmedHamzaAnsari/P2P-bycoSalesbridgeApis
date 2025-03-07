<?php
// fetch.php  
include("../config.php");

$access_key = '03201232927';

$pass = $_GET["key"] ?? '';
$pre = $_GET["pre"] ?? '';
$id = $_GET["user_id"] ?? '';
$from = $_GET["from"] ?? '';
$to = $_GET["to"] ?? '';

if (!empty($pass)) {
    if ($pass === $access_key) {
        $thread = [];

        // Fetch TM users
        $sql_tms = "SELECT us.*, du.name as pre_name, dt.name as dpt_name 
                    FROM bycobridge.department_users as du 
                    JOIN users as us ON us.privilege = du.id
                    JOIN department as dt ON dt.id = du.department_id
                    WHERE dt.name = 'Retail Network' AND du.name = 'TM'";

        $result_tm = $db->query($sql_tms) or die("Error: " . $db->error);

        while ($user_tm = $result_tm->fetch_assoc()) {
            $inspection_report = 0;
            $ehs_report = 0;
            $recon_report = 0;
            $profitability_report = 0;
            $decant_report = 0;

            $tm_id = intval($user_tm['id']);
            $tm_name = $user_tm['name'];
            $dealer_ids = $user_tm['dealer_ids'];

            if (!empty($dealer_ids)) {
                $sql_query1 = "SELECT id, name FROM bycobridge.dealers 
                               WHERE privilege = 'Dealer' AND id IN($dealer_ids) 
                               ORDER BY name ASC";

                $result1 = $db->query($sql_query1) or die("Error: " . $db->error);
                $dealers = 0;

                while ($user = $result1->fetch_assoc()) {
                    $dealer_id = intval($user['id']);
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
                                   WHERE it.time >= '$from' AND it.time <= '$to' AND dd.id = $dealer_id";

                    $result2 = $db->query($sql_query2) or die("Error: " . $db->error);

                    while ($task = $result2->fetch_assoc()) {
                        $json_form = json_decode($task['form_json'], true);

                        if (json_last_error() === JSON_ERROR_NONE) {
                            foreach ($json_form as $form) {
                                if (isset($form['form_name'], $form['status']) && $form['status'] == 1) {
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
            }

            // Fetch total counts per dealer
            $sql_query3 = "SELECT 
            id, 
            sap_no, 
            name,
            
            -- Checking all four conditions and picking the max count
            GREATEST(
                COALESCE(
                    (SELECT COUNT(DISTINCT rr.task_id) 
                     FROM bycobridge.inspector_task AS it
                     JOIN bycobridge.dealer_stock_recon_new AS rr ON rr.task_id = it.id
                     WHERE it.dealer_id = dl.id AND DATE(it.time) BETWEEN '$from' AND '$to'
                    ), 0
                ),
                COALESCE(
                    (SELECT COUNT(DISTINCT rr.inspection_id) 
                     FROM bycobridge.inspector_task AS it
                     JOIN bycobridge.survey_response_main AS rr ON rr.inspection_id = it.id
                     WHERE it.dealer_id = dl.id AND DATE(it.time) BETWEEN '$from' AND '$to'
                    ), 0
                ),
                COALESCE(
                    (SELECT COUNT(DISTINCT rr.inspection_id) 
                     FROM bycobridge.inspector_task AS it
                     JOIN bycobridge.hec_response_main AS rr ON rr.inspection_id = it.id
                     WHERE it.dealer_id = dl.id AND DATE(it.time) BETWEEN '$from' AND '$to'
                    ), 0
                ),
                COALESCE(
                    (SELECT COUNT(DISTINCT rr.task_id) 
                     FROM bycobridge.inspector_task AS it
                     JOIN bycobridge.dealers_profitability_main AS rr ON rr.task_id = it.id
                     WHERE it.dealer_id = dl.id AND DATE(it.time) BETWEEN '$from' AND '$to'
                    ), 0
                )
            ) AS total_count,
        
            -- Getting distinct dealer count by checking all four tables
            GREATEST(
                COALESCE(
                    (SELECT COUNT(DISTINCT it.dealer_id) 
                     FROM bycobridge.inspector_task AS it
                     JOIN bycobridge.dealer_stock_recon_new AS rr ON rr.task_id = it.id
                     WHERE DATE(it.time) BETWEEN '$from' AND '$to' 
                     AND it.dealer_id = dl.id
                    ), 0
                ),
                COALESCE(
                    (SELECT COUNT(DISTINCT it.dealer_id) 
                     FROM bycobridge.inspector_task AS it
                     JOIN bycobridge.survey_response_main AS rr ON rr.inspection_id = it.id
                     WHERE DATE(it.time) BETWEEN '$from' AND '$to' 
                     AND it.dealer_id = dl.id
                    ), 0
                ),
                COALESCE(
                    (SELECT COUNT(DISTINCT it.dealer_id) 
                     FROM bycobridge.inspector_task AS it
                     JOIN bycobridge.hec_response_main AS rr ON rr.inspection_id = it.id
                     WHERE DATE(it.time) BETWEEN '$from' AND '$to' 
                     AND it.dealer_id = dl.id
                    ), 0
                ),
                COALESCE(
                    (SELECT COUNT(DISTINCT it.dealer_id) 
                     FROM bycobridge.inspector_task AS it
                     JOIN bycobridge.dealers_profitability_main AS rr ON rr.task_id = it.id
                     WHERE DATE(it.time) BETWEEN '$from' AND '$to' 
                     AND it.dealer_id = dl.id
                    ), 0
                )
            ) AS distinct_count
        
        FROM bycobridge.dealers AS dl 
        WHERE dl.id IN($dealer_ids);";

            $result3 = $db->query($sql_query3) or die("Error: " . $db->error);

            $total_site = 0;
            $total_count = 0;
            $distinct_count = 0;

            while ($user3 = $result3->fetch_assoc()) {
                $total_site++;
                $total_count += $user3['total_count'];
                $distinct_count += $user3['distinct_count'];
            }
            $per = ($distinct_count/$total_site)*100;
            // Prepare final response array
            $report_data = [
                "id" => $tm_id,
                "tm_name" => $tm_name,
                "inspection_count" => $inspection_report,
                "ehs_count" => $ehs_report,
                "recon_count" => $recon_report,
                "profitability_count" => $profitability_report,
                "decant_count" => $decant_report,
                "total_site" => $total_site,
                "total_count" => $total_count,
                "distinct_count" => $distinct_count,
                "rank" => $per,
            ];

            $thread[] = $report_data;
        }

        usort($thread, function ($a, $b) {
            return $b['rank'] - $a['rank']; // Descending Order (Greatest rank first)
        });
        

        echo json_encode($thread, JSON_PRETTY_PRINT);

    } else {
        echo json_encode(["error" => "Wrong Key"]);
    }
} else {
    echo json_encode(["error" => "Key is Required"]);
}
?>
