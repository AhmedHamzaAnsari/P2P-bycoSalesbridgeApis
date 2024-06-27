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

include ('../class/class.phpmailer.php');
include ('../pdf.php');

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

$email = $_GET['email'];
$name = $_GET['name'];

$connect = new PDO("mysql:host=localhost;dbname=bycobridge", "root", "Ptoptrack@(!!@");

// Check if the current hour is 9 AM





// Check if the current hour is 9 AM
if ($dealer_id != "" && $task_id != "" && $email != "") {

    echo smtp_mailer($email, date('Y-m-d H:i:s'), $name, $dealer_id, $task_id, $db);

    


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
            if ($item['form_name'] === 'Stock Reconciliation') {
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
        SELECT rn.*,dp.name as product_name,dd.name as dealer_name FROM bycobridge.dealer_stock_recon_new  as rn
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
        // print_r($is_totalizer);
        // Decode JSON string into an array


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
            // Initialize an array to hold filtered items
            $filteredData = array();

            // Iterate through each item in the array
            foreach ($data_main as $item) {
                // Check if the form_name is 'Inspection'
                $output .= '<tr>
                <th>' . $item["name"] . '</th>
                <td>' . $item["opening_dip"] . '</td>
                <td>' . $item["closing_dip"] . '</td>
                <td></td>
                <td>' . $item["opening"] . '</td>
                <td>' . $item["closing"] . '</td>
                </tr>';
            }


        } else {
            echo "Failed to decode JSON.";
        }

        $output .= '<tr>
        <th colspan="2">Opening Stock</th>
        <td>' . $sum_of_opening . '</td>
        <th colspan="2">Physical Stock</th>
        <td>' . $sum_of_closing . '</td>
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

        // Access the elements of the array
        foreach ($data_array as $item) {
            $output .= ' <tr>
                <th>' . $item["dispenser_name"] . ' - ' . $item["name"] . '</th>
                <td></td>
                <td></td>
                <td>' . $item["opening"] . '</td>
                <td>' . $item["closing"] . '</td>
                <td>' . (floatval($item["closing"]) - floatval($item["opening"])) . '</td>
                </tr>';
        }
        // Check if json_decode returned an array

        $data_is_totalizer_data = json_decode($is_totalizer, true);
        // Access the elements of the array
        foreach ($data_is_totalizer_data as $item) {
            $output .= ' <tr>
                <th>' . $item["dispenser_name"] . ' - ' . $item["name"] . ' (Change Totalizer)</th>
                <td></td>
                <td></td>
                <td>' . $item["opening"] . '</td>
                <td>' . $item["closing"] . '</td>
                <td>' . (floatval($item["closing"]) - floatval($item["opening"])) . '</td>
                </tr>';
        }
        // Check if json_decode returned an array
        $output .= '<tr>
        <td></td>
        <td></td>
        <td></td>
        <th colspan="2">Total Sales for the Period</th>
        <td>' . $total_sales . '</td>
    </tr>';

        $output .= '</table>';

        $output .= '<div class="col-md-12">
        <p style="background: #e3dede;padding: 5px 7px;text-align: center;">
        </p>
        <table class="dynamic_table" style="width:100%">
            <tr>
                <th>Total Reciepts</th>
                <td class="">' . $total_recipt . ' (IN LTRS)</td>

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
            <th>Book Value</th>


        </tr>
        <tr>
            <td>' . $sum_of_opening . '</td>
            <td>' . $total_recipt . '</td>
            <td>' . $total_sales . '</td>
            <td style="text-align: center;">=</td>
            <td>' . $book_value . '</td>
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
        <td>' . $sum_of_closing . '</td>
        <td>' . $book_value . '</td>
        <td style="text-align: center;">=</td>
        <td>' . $variance . '</td>
    </tr>

</table>
</div>';

        $output .= '<div class="col-md-12">
<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
</p>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Remarks</th>
        <td class="w-50" class="">' . $remark . '</td>

    </tr>

</table>
</div>
<div class="col-md-12">
<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
</p>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Shortage Claim for the period (TLs short received by in Ltrs)</th>
        <td class="w-50" class="">' . $shortage_claim . '</td>

    </tr>

</table>
</div>
<div class="col-md-12">
<h6 style="background: #e3dede;padding: 5px 7px;text-align: center;">
</h6>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Net Gain or Loss</th>
        <td class="w-50" class="">' . $variance . '</td>

    </tr>

</table>
</div>';
$output .= '<div class="col-md-12">
<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
</p>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Variance as % of Sales (for the period.)</th>
        <td class="w-50" class="">'.$variance_of_sales.'</td>

    </tr>

</table>
</div>
<div class="col-md-12">
<p style="background: #e3dede;padding: 5px 7px;text-align: center;">
</p>
<table class="dynamic_table" style="width:100%">
    <tr>
        <th class="w-50">Average Daily sales</th>
        <td class="w-50" class="">'.$average_daily_sales.'</td>

    </tr>

</table>
</div>';
    }

    $stmt->close();
    return $output;
}







function smtp_mailer($to, $time, $dealer_name, $dealer_id, $task_id, $db)
{
    $connect = new PDO("mysql:host=localhost;dbname=bycobridge", "root", "Ptoptrack@(!!@");
    $alert_today = date("Y-m-d");
    $alert_today_time = date("Y-m-d H:i:s");
    // $verificationCode = generateVerificationCode();
    // $alert_link = "";
    // $alert_link = "http://151.106.17.246:8080/sitara/email_alert_link.php?id=" . $cartraige_id . "&from=" . $alert_today . "&name=" . $cartraige_name . "&interval=" . $currentHour . "&e_id=" . $to . "";

    $file_name5 = '../files/Stock Reconciliation Report_' . md5(rand()) . '.pdf';
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
    $mail->Username = "sitaras222@gmail.com";
    $mail->Password = "kjyqvamkejoqtbki";
    $mail->SetFrom("sitaras222@gmail.com");
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