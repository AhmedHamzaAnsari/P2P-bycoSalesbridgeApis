<?php
//fetch.php  
ini_set('max_execution_time', '0');
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 20; URL=$url1");
include ("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM reports_emailers where status=0";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $count = mysqli_num_rows($result1);
        if($count>0){
            $thread = array();
            while ($user = $result1->fetch_assoc()) {
    
                $id = $user['id'];
                $task_id = $user['task_id'];
                $dealer_id = $user['dealer_id'];
                $tm_id = $user['tm_id'];
                $report_name = $user['report_name'];
                $form_id = $user['form_id'];
                $form_name = $user['form_name'];
                // echo $form_json . '<br>';
    
                echo "Form Name: " . $form_name . " - id = : " . $id . "<br>";
                if ($form_name == 'Inspection') {
                    send_report('inspection_emailer', $task_id, $dealer_id, $tm_id,$id , $db);
    
                } elseif ($form_name == 'Stock Reconciliation') {
                    send_report('recon_emailer', $task_id, $dealer_id, $tm_id,$id , $db);
    
                } elseif ($form_name == 'Fuel Decantation Audit') {
                    send_report('fuel_decant_emailer', $task_id, $dealer_id, $tm_id,$id , $db);
    
                } elseif ($form_name == 'Retailer Profitability') {
                    send_report('profitibilty_emailer', $task_id, $dealer_id, $tm_id,$id , $db);
    
                } elseif ($form_name == 'EHS Audit') {
                    send_report('ehs_emailer', $task_id, $dealer_id, $tm_id,$id , $db);
    
                }
            }

        }else{
            echo 'No Request Founds';
        }

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}

echo 'Last run '.date('Y-m-d H:i:s');

function send_report($links, $task_id, $dealer_id, $tm_id, $row_id, $db)
{

 
    $curl = curl_init();

    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'http://151.106.17.246:8080/bycobridgeApis/emailer/' . $links . '.php?dealer_id=' . $dealer_id . '&task_id=' . $task_id . '&tm_id=' . $tm_id . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    if ($response == 1) {
        echo 'Report Not Send';
    } else {
        echo 'Report Send';
        $date_time = date('Y-m-d H:i:s');
        $query_update = "UPDATE `reports_emailers`
        SET
        `status` = '1',
        `updated_at` = '$date_time'
        WHERE `id` = '$row_id';";

        if (mysqli_query($db, $query_update)) {
            echo 1;

        } else {
            echo 0;

        }

    }

}

?>