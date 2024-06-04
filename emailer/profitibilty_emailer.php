<?php

// error_reporting(0);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Ptoptrack@(!!@');
define('DB_DATABASE', 'bycobridge');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// error_reporting(0);
//index.php
ini_set('memory_limit', '-1');
set_time_limit(500);

include ('class/class.phpmailer.php');
include ('pdf.php');

$today = date("Y-m-d");
$_to_today = date("Y-m-d H:i:s");
$_to_today . 'Run time <br>';
$report_time = 1;
$report = 'vehicle';
$user_id;
$privilege = 'Admin';
$time_1 = "";
$black_1 = "";
$cartraige_name = "";
$report_timing = "";

$dealer_id = $_GET['dealer_id'];
$task_id = $_GET['task_id'];
$get_email = $_GET['email'];



$connect = new PDO("mysql:host=localhost;dbname=bycobridge", "root", "Ptoptrack@(!!@");

// Check if the current hour is 9 AM
if ($dealer_id != "" || $task_id != "") {
    // Execute your PHP script here

    // $sql_get_cartraige_no = "SELECT * FROM dealers where id='$dealer_id';";
    // // echo $sql_get_cartraige_no .'<br>';
    // $result_contact = mysqli_query($db, $sql_get_cartraige_no);

    // $count_contact = mysqli_num_rows($result_contact);
    // // echo $count_contact . ' hamza <br>';

    // if ($count_contact > 0) {
    //     while ($row = mysqli_fetch_array($result_contact)) {
    //         $name = $row["name"];
    //         $email = 'ahmedhamzaansari.99@gmail.com';
    //         echo smtp_mailer($email, date('Y-m-d H:i:s'), $name, $dealer_id, $task_id, $db);

    //     }
    // }

    echo smtp_mailer($get_email, date('Y-m-d H:i:s'), '', $dealer_id, $task_id, $db);

    echo get_task_inspection_response($connect, $task_id, $dealer_id, $db);


} else {
    // Do nothing or perform other actions
    echo "IO Required.";
}
// $connect = new PDO("mysql:host=localhost;dbname=bycobridge", "root", "Ptoptrack@(!!@");






function get_task_inspection_response($connect, $task_id, $dealer_id, $db)
{
    // Query to get all survey categories
    $output = '';
    $sql = "SELECT ii.*, us.name AS user_name, du.department_id, du.parent_id, ii.created_at AS task_create_time,
    dd.name AS dealer_name  FROM bycobridge.inspector_task as ii
   JOIN users AS us ON us.id = ii.user_id
   JOIN department_users AS du ON du.id = us.privilege 
   JOIN dealers AS dd ON dd.id = ii.dealer_id
   where ii.id=$task_id and ii.dealer_id=$dealer_id";

    // echo $sql;

    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    $jsonStringmain = $row["form_json"];

    // Decode JSON string into an array
    $data_main = json_decode($jsonStringmain, true);

    // Check if json_decode returned an array
    if (is_array($data_main)) {
        // Initialize an array to hold filtered items
        $filteredData = array();

        // Iterate through each item in the array
        foreach ($data_main as $item) {
            // Check if the form_name is 'Inspection'
            if ($item['form_name'] === 'Retailer Profitability') {
                // Add the item to the filtered array
                $filteredData[] = $item;
            }
        }

        // Encode the filtered array back to JSON
        $filteredJsonString = json_encode($filteredData, JSON_PRETTY_PRINT);

        // Output the filtered JSON string
        // echo $filteredJsonString;
    } else {
        echo "Failed to decode JSON.";
    }
    $jsonString = $filteredJsonString;

    // Decode JSON string into an array
    $data = json_decode($jsonString, true);
    $output = 'Report Name : ' . $data[0]['form_name'] . ' <br/>
        Date of Audit : ' . $row["time"] . ' <br/>
        Complete Time : ' . $data[0]['Completion_time'] . ' <br/>
        Site Name : ' . $row["dealer_name"] . ' <br/>
        Name of Auditor(s) : ' . $row['user_name'] . '<hr>';
    $sql_query1 = "
    SELECT * FROM dealers_profitability as dp
    join dealers_profitability_main as pm on pm.id=dp.main_id
    JOIN dealers AS dd ON dd.id = dp.dealer_id
    where pm.task_id=$task_id and pm.dealer_id=$dealer_id;
    ";

    $stmt = $db->prepare($sql_query1);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $output .= '
                <style>
                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    th, td {
                        padding:10px;
                    }
                    th {
                        border: 1px solid;
                        padding: 8px;
                        text-align: left;
                        background-color: #f2f2f2;
                    }
                </style>';
    $output .= '
    <h6 style="text-align: center;padding: 3px 11px;background: #f2f2f2;">Dealer Profitability</h6>
    <table class="dynamic_table" style="width:100%">
        <tr>
            <th>Dealer Profitability</th>
            <th>CF</th>
            <th>SF</th>
            <th>DF</th>
        </tr>';

    $sum_cf = 0;
    $sum_sf = 0;
    $sum_df = 0;
    while ($taskDetails = $result1->fetch_assoc()) {
        $retailer_profitability = $taskDetails["retailer_profitability"];
        $cf = $taskDetails["cf"];
        $sf = $taskDetails["sf"];
        $df = $taskDetails["df"];

        $sum_cf += floatval($cf);
        $sum_sf += floatval($sf);
        $sum_df += floatval($df);

        $output .= '<tr>
            <th>' . $retailer_profitability . '</th>
            <td>' . $cf . '</td>
            <td>' . $sf . '</td>
            <td>' . $df . '</td>
        </tr>';


    }
    $output .= '<tr>
    <th>Net Income</th>
    <td>' . number_format($sum_cf, 2) . '</td>
    <td>' . number_format($sum_sf, 2) . '</td>
    <td>' . number_format($sum_df, 2) . '</td>
</tr>';


    $stmt->close();
    return $output;
}


function header_report($connect, $task_id, $dealer_id, $db)
{
    $sql_query1 = "SELECT * FROM hec_response_main WHERE inspection_id='$task_id' AND dealer_id='$dealer_id'";
    $result = mysqli_query($db, $sql_query1);
    $row = mysqli_fetch_assoc($result);

    $facilities = $row['nfr_facilities'];
    $retail_product = $row['retail_product'];
    $ug_storage_tanks = $row['ug_storage_tanks'];
    $auditor_name = $row['auditor_name'];
    $auditor_designation = $row['auditor_designation'];
    $audit_date = $row['audit_date'];
    $retail_site_name = $row['retail_site_name'];
    $location = $row['location'];
    $address = $row['address'];
    $city = $row['city'];
    $province = $row['province'];
    $region = $row['region'];
    $last_audit_date = $row['last_audit_date'];
    $name_retailer_manager = $row['name_retailer_manager'];

    $html_code = 'Designation of Auditor(s) : ' . $auditor_designation . '<br/>
           Retail Product : ';

    $json_data = $retail_product;
    $data_array = json_decode($json_data, true);

    foreach ($data_array as $item) {
        $html_code .= $item['product_name'] . ' : ' . strtoupper($item['answer']) . ' , ';
    }

    $html_code .= '<br/> Number of U/G Storage Tanks : ';
    $json_data = $ug_storage_tanks;
    $data_array = json_decode($json_data, true);

    foreach ($data_array as $item) {
        $html_code .= $item['product_name'] . ' : ' . $item['capacity'] . ' , ';
    }
    $html_code .= '<br/> NFR Facilities : ';

    $json_data = $facilities;
    $data_array = json_decode($json_data, true);

    foreach ($data_array as $item) {
        $html_code .= $item['fac_name'] . ' : ' . strtoupper($item['answer']) . ' , ';
    }


    $html_code .= '<br/> Location : ' . $location . ' <br/>
    Address : ' . $address . ' <br/>
    City : ' . $city . ' - 
    Province : ' . $province . ' - 
    Region : ' . $region . ' <br/>
    Name of Retailer Representative/ Manager : ' . $name_retailer_manager . '';

    return $html_code;
}

function count_per($connect, $task_id, $dealer_id, $db)
{
    $get_orders = "SELECT count(*) total_count,response FROM bycobridge.hec_response where inspection_id=$task_id and dealer_id=$dealer_id group by response;";
    // echo $get_orders .'<br>';
    $result_orders = $db->query($get_orders);
    $total_ques = 0;
    $r_yes = 0;
    $r_no = 0;
    $r_n_a = 0;

    while ($row_2 = $result_orders->fetch_assoc()) {

        $total_count = $row_2['total_count'];
        $response = $row_2['response'];
        if ($response == 'N/A') {
            $r_n_a = $total_count;

        } else if ($response == 'No') {
            $r_no = $total_count;

        } else if ($response == 'Yes') {
            $r_yes = $total_count;
        }

    }

    $total_sum = $r_yes + $r_no + $r_n_a;


    // Initialize variables

    // HTML table structure
    $table1 = '<table class="dynamic_table" id="questions_total">
                    <thead>
                        <tr>
                            <th>Total Questions</th>
                            <th>Yes</th>
                            <th>No</th>
                            <th>N/A</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>';



    // Calculate percentage
    $percentage = ($total_sum > 0) ? (($total_sum - $r_n_a) / $total_sum) * 100 : 0;

    // Append data to the HTML table
    $table1 .= '<tr>
                    <td>' . $total_sum . '</td>
                    <td>' . $r_yes . '</td>
                    <td>' . $r_no . '</td>
                    <td>' . $r_n_a . '</td>
                    <td>' . round($percentage) . '</td>
                </tr>';

    // Close the HTML table
    $table1 .= '</tbody></table>';

    return $table1;
}




function smtp_mailer($to, $time, $dealer_name, $dealer_id, $task_id, $db)
{
    $connect = new PDO("mysql:host=localhost;dbname=bycobridge", "root", "Ptoptrack@(!!@");
    $alert_today = date("Y-m-d");
    $alert_today_time = date("Y-m-d H:i:s");
    // $verificationCode = generateVerificationCode();
    // $alert_link = "";
    // $alert_link = "http://151.106.17.246:8080/sitara/email_alert_link.php?id=" . $cartraige_id . "&from=" . $alert_today . "&name=" . $cartraige_name . "&interval=" . $currentHour . "&e_id=" . $to . "";

    $file_name5 = 'files/Retailer Profitability Report_' . md5(rand()) . '.pdf';
    $html_code5 = '<div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <h2 style="font-weight: bold;color: #3e3ea7;font-size: 72px;font-style: italic;font-weight: bold;text-decoration: underline">Cnergyico</h2>
                    
                    </div>
                      
                    

                    

                </div>
            </div>';

    $html_code5 .= get_task_inspection_response($connect, $task_id, $dealer_id, $db);

    $pdf5 = new Pdf();
    $pdf5->load_html($html_code5);
    $pdf5->render();
    $file5 = $pdf5->output();
    file_put_contents($file_name5, $file5);

    // ---------------------------------------------Stock Variations End----------------------------------------------------------


    // require 'class/class.phpmailer.php';
    $mail = new PHPMailer();
    $mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "sitaras222@gmail.com";
    $mail->Password = "kjyqvamkejoqtbki";
    $mail->SetFrom("sitaras222@gmail.com");
    $mail->AddAddress($to);
    $mail->WordWrap = 50; //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true); //Sets message type to HTML				
    $mail->AddAttachment($file_name5);
    $mail->Subject = $dealer_name . ' Retailer Profitability Audit Report ' . $time; //Sets the Subject of the message
    $mail->Body = '<h1>Cnergyico.<h1><h3>Please Find details report of Retailer Profitability Audit in attach PDF File.</h3>'; //An HTML or plain text message body
    if ($mail->Send()) //Send an Email. Return true on success or false on error
    {

        echo 1;
        // $sql_update = "UPDATE `inspector_task`
        // SET 
        // `email_status` = 1
        // WHERE `id` = $task_id;";

        // if (mysqli_query($db, $sql_update)) {
        //     echo 1;

        // } else {
        //     echo 0;

        // }


    } else {
        echo 0;
    }
    unlink($file_name5);
}
function generateVerificationCode($length = 6)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
}



// echo $list;


?>