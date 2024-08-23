<?php
// fetch.php  
include("../config.php");

$access_key = '03201232927';

$pass = $_GET["key"];
$pre = $_GET["pre"];
$id = $_GET["user_id"];
$from = $_GET["from"];
$to = $_GET["to"];

if ($pass != '') {
    if ($pass == $access_key) {
        $thread = array();

        $sql_query1 = "SELECT * FROM bycobridge.dealers WHERE privilege='Dealer' ORDER BY name ASC;";
        $result1 = $db->query($sql_query1) or die("Error: " . $db->error);

        while ($user = $result1->fetch_assoc()) {
            $dealer_id = $user['id'];
            $dealer_name = $user['name'];

            $city = $user['city'];
            $province = $user['province'];
            $region = $user['region'];
            $terr = $user['terr'];
            $actual_depot = $user['actual_depot'];
            $location_cat = $user['cat_1'];
            $invest_type = $user['finance'];

            $inspection_report = 0;
            $ehs_report = 0;
            $recon_report = 0;
            $profitability_report = 0;
            $decant_report = 0;

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
             WHERE it.created_at >= '$from' AND it.created_at <= '$to' AND dd.id = $dealer_id;";

            $result2 = $db->query($sql_query2) or die("Error: " . $db->error);

            while ($task = $result2->fetch_assoc()) {

                // Assuming 'form_json' is a JSON string, decode it
                $json_form = json_decode($task['form_json'], true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    foreach ($json_form as $form) {
                        if (isset($form['form_name'])) {
                            $form_name = $form['form_name'];
                            if ($form_name == 'Inspection') {
                                if ($form['status'] == 1) {
                                    $inspection_report++;
                                }
                            } elseif ($form_name == 'Stock Reconciliation') {
                                if ($form['status'] == 1) {
                                    $recon_report++;
                                }
                            } elseif ($form_name == 'Fuel Decantation Audit') {
                                if ($form['status'] == 1) {
                                    $decant_report++;
                                }
                            } elseif ($form_name == 'Retailer Profitability') {
                                if ($form['status'] == 1) {
                                    $profitability_report++;
                                }
                            } elseif ($form_name == 'EHS Audit') {
                                if ($form['status'] == 1) {
                                    $ehs_report++;
                                }
                            }
                        }
                    }
                } else {
                    echo "Error decoding JSON: " . json_last_error_msg();
                }
            }

            $report_data = array(
                "id" => $id,
                "dealer_name" => $dealer_name,
                "city" => $city,
                "province" => $province,
                "region" => $region,
                "terr" => $terr,
                "actual_depot" => $actual_depot,
                "location_cat" => $location_cat,
                "invest_type" => $invest_type,
                "inspection_count" => $inspection_report,
                "ehs_count" => $ehs_report,
                "recon_count" => $recon_report,
                "profitability_count" => $profitability_report,
                "decant_count" => $decant_report
            );

            $thread[] = $report_data;
        }

        // Output the full thread as a JSON response
        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }
} else {
    echo 'Key is Required';
}
?>
