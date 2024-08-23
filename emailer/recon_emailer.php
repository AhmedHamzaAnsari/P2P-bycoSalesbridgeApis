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
// $get_email = $_GET['email'];

$tm_id = $_GET['tm_id'];



$connect = new PDO("mysql:host=localhost;dbname=bycobridge", "root", "Ptoptrack@(!!@");

// Check if the current hour is 9 AM
if ($dealer_id != "" && $task_id != "" && $tm_id != "") {
    $sql_get_cartraige_no = "SELECT us.id as tm_id,
    us.name as tm_name,
    us.login as tm_email,
    du.name as tm_pre,
    urm.id as rm_id,
    urm.name as rm_name,
    urm.login as rm_email,
    dru.name as rm_pre,
    nsm.id as nsm_id,
    nsm.name as nsm_name,
    nsm.login as nsm_email,
    dnsm.name as nsm_pre,
    grm.id as grm_id,
    grm.name as grm_name,
    dgrm.name as grm_pre,
    grm.login as grm_email FROM department_users as du 
    join users as us on us.privilege=du.id
    join department_users as dru on dru.id=du.parent_id
    join users as urm on urm.privilege=dru.id
    join department_users as dnsm on dnsm.id=dru.parent_id
    join users as nsm on nsm.privilege=dnsm.id
    join department_users as dgrm on dgrm.id=dnsm.parent_id
    join users as grm on grm.privilege=dgrm.id
    where us.id=$tm_id and du.name='TM' and urm.id=us.subacc_id;";
    // echo $sql_get_cartraige_no .'<br>';
    $result_contact = mysqli_query($db, $sql_get_cartraige_no);

    $count_contact = mysqli_num_rows($result_contact);
    // echo $count_contact . ' hamza <br>';

    if ($count_contact > 0) {

        $sql = "SELECT * FROM bycobridge.dealers where id=$dealer_id";

        // echo $sql;

        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result);

        $dealer_name = $row['name'];
        while ($row = mysqli_fetch_array($result_contact)) {
            $tm_id = $row["tm_id"];
            $tm_name = $row["tm_name"];
            $tm_email = $row["tm_email"];
            $tm_pre = $row["tm_pre"];

            $rm_id = $row["rm_id"];
            $rm_name = $row["rm_name"];
            $rm_email = $row["rm_email"];
            $rm_pre = $row["rm_pre"];

            $nsm_id = $row["nsm_id"];
            $nsm_name = $row["nsm_name"];
            $nsm_email = $row["nsm_email"];
            $nsm_pre = $row["nsm_pre"];

            $grm_id = $row["grm_id"];
            $grm_name = $row["grm_name"];
            $grm_email = $row["grm_email"];
            $grm_pre = $row["grm_pre"];

            echo smtp_mailer($tm_email, date('Y-m-d H:i:s'), $dealer_name, $dealer_id, $task_id, $db);
            echo smtp_mailer($rm_email, date('Y-m-d H:i:s'), $dealer_name, $dealer_id, $task_id, $db);
            echo smtp_mailer($nsm_email, date('Y-m-d H:i:s'), $dealer_name, $dealer_id, $task_id, $db);
            echo smtp_mailer($grm_email, date('Y-m-d H:i:s'), $dealer_name, $dealer_id, $task_id, $db);
            echo smtp_mailer('wasi.shaikh@cnergyico.com', date('Y-m-d H:i:s'), $dealer_name, $dealer_id, $task_id, $db);
            echo smtp_mailer('abasit9119@gmail.com', date('Y-m-d H:i:s'), $dealer_name, $dealer_id, $task_id, $db);
            echo smtp_mailer('ali.nazim@cnergyico.com', date('Y-m-d H:i:s'), $dealer_name, $dealer_id, $task_id, $db);
            echo smtp_mailer('usmanhameed@gmail.com', date('Y-m-d H:i:s'), $dealer_name, $dealer_id, $task_id, $db);

        }
    }


    // echo get_task_inspection_response($connect, $task_id, $dealer_id, $db);


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
            if ($item['form_name'] === 'Stock Reconciliation') {
                // Add the item to the filtered array
                $filteredData[] = $item;
            }
        }

        // Encode the filtered array back to JSON
        $filteredJsonString = json_encode($filteredData, JSON_PRETTY_PRINT);

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
    $sql_query1 = "SELECT rn.*,dp.name as product_name,dd.name as dealer_name FROM bycobridge.dealer_stock_recon_new  as rn
        join all_products as dp on dp.id=rn.product_id
        JOIN dealers AS dd ON dd.id = rn.dealer_id
        where rn.task_id=$task_id and rn.dealer_id=$dealer_id group by rn.product_id;
    ";

    $stmt = $db->prepare($sql_query1);
    $stmt->execute();
    $result1 = $stmt->get_result();

    while ($taskDetails = $result1->fetch_assoc()) {
        $total_days = $taskDetails["total_days"];
        $last_recon_date = $taskDetails["last_recon_date"];
        $sum_of_opening = $taskDetails["sum_of_opening"];
        $sum_of_closing = $taskDetails["sum_of_closing"];
        $total_sales = $taskDetails["total_sales"];
        $total_recipt = $taskDetails["total_recipt"];
        $book_value = $taskDetails["book_value"];
        $variance = $taskDetails["variance"];
        $remark = $taskDetails["remark"];
        $shortage_claim = $taskDetails["shortage_claim"];
        $variance_of_sales = $taskDetails["variance_of_sales"];
        $average_daily_sales = $taskDetails["average_daily_sales"];
        $created_at = $taskDetails["created_at"];
        $product_name = $taskDetails["product_name"];
        $dealer_name = $taskDetails["dealer_name"];
        $tanks = $taskDetails["tanks"];
        $nozzle = $taskDetails["nozzel"];
        $is_totalizer = $taskDetails["is_totalizer_data"];
        $variance_of_sales = $taskDetails["variance_of_sales"];
        $average_daily_sales = $taskDetails["average_daily_sales"];

        $output .= '<p style="background: #e3dede;padding: 5px 7px;text-align: center;">Stock Reconciliation ' . $product_name . '</p>
        Product : ' . $product_name . ' <br/>
        Total Days : ' . $total_days . ' <br/>
        From : ' . $last_recon_date . ' <br/>
        To  : ' . $created_at . ' <br/>';

        $output .= "<hr>";
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
                <p style="background: #e3dede;padding: 5px 7px;text-align: center;">
                Opening and Closing Dips</p>
            <table class="dynamic_table" style="width:100%">
                <tr>
                    <th></th>
                    <th colspan="2" style="text-align: center;">Opening</th>
                    <th></th>
                    <th colspan="2" style="text-align: center;">Closing</th>
                </tr>
                <tr>
                    <th>Tanks</th>
                    <th>Dip mm</th>
                    <th>Qty in Ltrs</th>
                    <td></td>
                    <th>Dip mm</th>
                    <th>Qty in Ltrs</th>
                    </tr>';

        $data_main = json_decode($tanks, true);

        // Check if json_decode returned an array
        if (is_array($data_main)) {
            foreach ($data_main as $item) {
                $output .= '<tr>
                <th>' . $item["name"] . '</th>
                <td>' . format_amount($item["opening_dip"]) . '</td>
                <td>' . format_amount($item["opening"]) . '</td>
                <td></td>
                <td>' . format_amount($item["closing_dip"]) . '</td>
                <td>' . format_amount($item["closing"]) . '</td>
                </tr>';
            }
        } else {
            echo "Failed to decode JSON.";
        }

        $output .= '<tr>
        <th colspan="2">Opening Stock</th>
        <td>' . format_amount($sum_of_opening) . '</td>
        <th colspan="2">Physical Stock</th>
        <td>' . format_amount($sum_of_closing) . '</td>
    </tr>';
        $output .= '</table>';

        $output .= '<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
        Opening and Closing Meter Readings</p>
    <table class="dynamic_table" style="width:100%">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>Opening (A)</th>
            <th>Closing (B)</th>
            <th>Sales (B-A)</th>
            </tr>';

        $data_array = json_decode($nozzle, true);

        foreach ($data_array as $item) {
            $output .= ' <tr>
                <th>' . $item["dispenser_name"] . ' - ' . $item["name"] . '</th>
                <td></td>
                <td></td>
                <td>' . format_amount($item["opening"]) . '</td>
                <td>' . format_amount($item["closing"]) . '</td>
                <td>' . format_amount(floatval($item["closing"]) - floatval($item["opening"])) . '</td>
                </tr>';
        }

        $data_is_totalizer_data = json_decode($is_totalizer, true);

        foreach ($data_is_totalizer_data as $item) {
            $output .= ' <tr>
                <th>' . $item["dispenser_name"] . ' - ' . $item["name"] . ' (Change Totalizer)</th>
                <td></td>
                <td></td>
                <td>' . format_amount($item["opening"]) . '</td>
                <td>' . format_amount($item["closing"]) . '</td>
                <td>' . format_amount(floatval($item["closing"]) - floatval($item["opening"])) . '</td>
                </tr>';
        }

        $output .= '<tr>
        <td></td>
        <td></td>
        <td></td>
        <th colspan="2">Total Sales for the Period</th>
        <td>' . format_amount($total_sales) . '</td>
    </tr>';

        $output .= '</table>';

        $output .= '<div class="col-md-12">
        <p style="background: #e3dede;padding: 5px 7px;text-align: center;">
        </p>
        <table class="dynamic_table" style="width:100%">
            <tr>
                <th>Total Reciepts</th>
                <td class="">' . format_amount($total_recipt) . ' (IN LTRS)</td>
            </tr>
        </table>
    </div>
    <div class="col-md-12">
        <p style="background: #e3dede;padding: 5px 7px;text-align: center;">Final Analysis
        </p>
    </div>';

        $output .= '<div class="col-md-12">
    <table class="dynamic_table" style="width:100%">
        <tr>
            <th>(C) Opening Stock</th>
            <th>(D) Receipts</th>
            <th>(E) Sales</th>
            <th>(C+D-E) Equals to</th>
            <th>Book Stock</th>
        </tr>
        <tr>
            <td>' . format_amount($sum_of_opening) . '</td>
            <td>' . format_amount($total_recipt) . '</td>
            <td>' . format_amount($total_sales) . '</td>
            <td style="text-align: center;">=</td>
            <td>' . format_amount($book_value) . '</td>
        </tr>
    </table>
</div>';
        $output .= ' <div class="col-md-12">
<table class="dynamic_table" style="width:100%">
    <tr>
        <th>(F) Physical Stock</th>
        <th>(G) Book Stock</th>
        <th>(F-G) Equals to</th>
        <th>Variance</th>
    </tr>
    <tr>
        <td>' . format_amount($sum_of_closing) . '</td>
        <td>' . format_amount($book_value) . '</td>
        <td style="text-align: center;">=</td>
        <td>' . format_amount($variance) . '</td>
    </tr>
</table>
</div>';

        $output .= '
<div class="col-md-12">
<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
</p>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Shortage Claim for the period (TLs short received by in Ltrs)</th>
        <td class="w-50" class="">' . format_amount($shortage_claim) . '</td>
    </tr>
</table>
</div>
<div class="col-md-12">
<h6 style="background: #e3dede;padding: 5px 7px;text-align: center;">
</h6>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Net Gain or Loss</th>
        <td class="w-50" class="">' . format_amount($variance) . '</td>
    </tr>
</table>
</div>';
        $output .= '<div class="col-md-12">
<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
</p>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Variance as % of Sales (for the period.)</th>
        <td class="w-50" class="">' . format_amount($variance_of_sales) . '</td>
    </tr>
</table>
</div>
<div class="col-md-12">
<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
</p>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Average Daily sales</th>
        <td class="w-50" class="">' . format_amount($average_daily_sales) . '</td>
    </tr>
</table>
</div>
<div class="col-md-12">
<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
</p>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Remarks</th>
        <td class="w-50" class="">' . $remark . '</td>
    </tr>
</table>
</div>';
    }

    $stmt->close();
    // Replace fuel types
    $output = str_replace(['PMG', 'pmg', 'Pmg'], 'Gasoline', $output);
    $output = str_replace(['HSD', 'Hsd', 'hsd'], 'Diesel', $output);

    return $output;
}

// Helper function to format amounts
function format_amount($amount) {
    if (is_numeric($amount)) {
        return number_format($amount, 2);
    }
    return $amount;
}







function smtp_mailer($to, $time, $dealer_name, $dealer_id, $task_id, $db)
{
    $connect = new PDO("mysql:host=localhost;dbname=bycobridge", "root", "Ptoptrack@(!!@");
    $alert_today = date("Y-m-d");
    $alert_today_time = date("Y-m-d H:i:s");
    // $verificationCode = generateVerificationCode();
    // $alert_link = "";
    // $alert_link = "http://151.106.17.246:8080/sitara/email_alert_link.php?id=" . $cartraige_id . "&from=" . $alert_today . "&name=" . $cartraige_name . "&interval=" . $currentHour . "&e_id=" . $to . "";

    $file_name5 = 'files/Stock Reconciliation Report_' . md5(rand()) . '.pdf';
    $html_code5 = '';

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
    $mail->Username = "byco.alertinfo@gmail.com";
    $mail->Password = "cocrqreeqfbovzvi";
    $mail->SetFrom("byco.alertinfo@gmail.com");
    $mail->AddAddress($to);
    $mail->WordWrap = 50; //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true); //Sets message type to HTML				
    $mail->AddAttachment($file_name5);
    $mail->Subject = $dealer_name . ' Stock Reconciliation Audit Report ' . $time; //Sets the Subject of the message
    $mail->Body = '<h3>Dear Team,<br>Following is the Stock Reconciliation Audit Report attached in PDF Format for your review and action <br>Regards,</h3>'; //An HTML or plain text message body
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