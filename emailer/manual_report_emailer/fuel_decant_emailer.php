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



// Check if the current hour is 9 AM
if ($dealer_id != "" && $task_id != "" && $email != "") {

    echo smtp_mailer($email, date('Y-m-d H:i:s'), $name, $dealer_id, $task_id, $db);

    


} else {
    // Do nothing or perform other actions
    echo "IO Required.";
}
$connect = new PDO("mysql:host=localhost;dbname=bycobridge", "root", "Ptoptrack@(!!@");





function get_task_inspection_response($connect, $task_id, $dealer_id, $db)
{
    // Query to get all survey categories
    $query = "SELECT * FROM decant_category ORDER BY name ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $surveyCategories = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Query to get the inspector task details
    $sql = "
        SELECT ii.*, us.name AS user_name, du.department_id, du.parent_id, ii.created_at AS task_create_time,
               tr.created_at AS visit_close_time, dd.name AS dealer_name 
        FROM inspector_task AS ii
        JOIN users AS us ON us.id = ii.user_id
        JOIN department_users AS du ON du.id = us.privilege 
        JOIN dealers AS dd ON dd.id = ii.dealer_id
        LEFT JOIN inspector_task_response AS tr ON tr.task_id = ii.id
        WHERE ii.id = $task_id AND ii.dealer_id = $dealer_id
    ";
    $statement = $connect->prepare($sql);
    $statement->bindParam(':task_id', $task_id, PDO::PARAM_INT);
    $statement->bindParam(':dealer_id', $dealer_id, PDO::PARAM_INT);
    $statement->execute();
    $taskDetails = $statement->fetch(PDO::FETCH_ASSOC);


    $jsonStringmain = $taskDetails["form_json"];

    // Decode JSON string into an array
    $data_main = json_decode($jsonStringmain, true);

    // Check if json_decode returned an array
    if (is_array($data_main)) {
        // Initialize an array to hold filtered items
        $filteredData = array();

        // Iterate through each item in the array
        foreach ($data_main as $item) {
            // Check if the form_name is 'Inspection'
            if ($item['form_name'] === 'Fuel Decantation Audit') {
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

    // Prepare the output string
    // $output = '<img src="http://151.106.17.246:8080/bycobridgeApis/uploads/byco_logo.png" alt="Image description" style="width: 100px;float: right;">';
    $output = '';
    $output .= 'Report Name : ' . $data[0]["form_name"] . ' <br/>
    Date of Audit : ' . $taskDetails["time"] . ' <br/>
    Complete Time : ' . $data[0]['Completion_time'] . ' <br/>
    Site Name : ' . $taskDetails["dealer_name"] . ' <br/>
    Name of Auditor(s) : ' . $taskDetails['user_name'] . '';
    $output .= header_report($connect, $task_id, $dealer_id, $db);
    $output .= count_per($connect, $task_id, $dealer_id, $db);
    $output .= '
    <div class="table-responsive">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding:10px;
        }
    </style>';

    // Loop through each survey category and get responses
    foreach ($surveyCategories as $category) {
        $cat_id = $category['id'];

        $query1 = "
        SELECT sr.*,sq.question,rf.file as cancel_file FROM decant_response as sr 
            join decant_category_questions as sq on sq.id=sr.question_id
            LEFT JOIN decant_response_files rf ON (rf.question_id = sr.question_id and rf.inspection_id=sr.inspection_id)
            WHERE sr.category_id = :cat_id AND sr.inspection_id = :task_id AND sr.dealer_id = :dealer_id
        ";
        $statement1 = $connect->prepare($query1);
        $statement1->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        $statement1->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $statement1->bindParam(':dealer_id', $dealer_id, PDO::PARAM_INT);
        $statement1->execute();
        $responses = $statement1->fetchAll(PDO::FETCH_ASSOC);

        $output .= '<h3>' . $category["name"] . '</h3>';

        $output .= '
        <table>
            <tr>
                <th>S #</th>
                <th>Question</th>
                <th>Response</th>
                <th>Comments</th>
            </tr>';

        $counter = 1;
        foreach ($responses as $response) {
            $output .= '
            <tr>
                <td class="text-center">' . $counter . '</td>
                <td>' . $response["question"] . '</td>
                <td>' . $response["response"] . '</td>
                <td>' . $response["comment"] . '</td>
            </tr>';
            $counter++;
        }

        $output .= '</table>';
    }

    $output .= '</div>';
    return $output;
}
function header_report($connect, $task_id, $dealer_id, $db)
{
    $html_code ='';
    $sql_query1 = "SELECT * FROM decant_response_main WHERE inspection_id='$task_id' AND dealer_id='$dealer_id'";
    $result = mysqli_query($db, $sql_query1);
    $row = mysqli_fetch_assoc($result);


    $header_data = $row['header_data'];

    $data_array = json_decode($header_data, true);

    // Iterate over the array and print each label and answer
    foreach ($data_array as $item) {
        $html_code .= $item["label"] . " : " . $item["answer"] . "<br>";
    }

    return $html_code;
}

function count_per($connect, $task_id, $dealer_id, $db)
{
    $get_orders = "SELECT count(*) total_count,response FROM bycobridge.decant_response where inspection_id=$task_id and dealer_id=$dealer_id group by response;";
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

    $file_name5 = '../files/Fuel Decantation Audit Report_' . md5(rand()) . '.pdf';
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
    $mail->Username = "mail.p2pbridge@gmail.com";
    $mail->Password = "hfnsbnkvauakgepf";
    $mail->SetFrom("mail.p2pbridge@gmail.com");
    $mail->AddAddress($to);
    $mail->WordWrap = 50; //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true); //Sets message type to HTML				
    $mail->AddAttachment($file_name5);
    $mail->Subject = $dealer_name . ' Fuel Decantation Audit Report ' . $time; //Sets the Subject of the message
    $mail->Body = '<h3>Dear Team,<br>Following is the  Fuel Decantation Audit Report attached in PDF Format for your review and action <br>Regards,</h3>'; //An HTML or plain text message body
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