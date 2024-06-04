<?php
//fetch.php  
include ("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM inspector_task where time>='2024-05-01' order by time asc;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $form_json = $user['form_json'];
            $id = $user['id'];
            $dealer_id = $user['dealer_id'];
            // echo $form_json . '<br>';
            $jsonString = $form_json;

            // Decode JSON string into a PHP array
            $formArray = json_decode($jsonString, true);

            // Check if json_decode returned an array
            if (is_array($formArray)) {
                // Loop through each form
                foreach ($formArray as $form) {
                    $formName = $form['form_name'];
                    $status = $form['status'];


                    // Output the form_name and status
                    if ($status == '1') {
                        if ($formName == 'Inspection') {

                            echo "Form Name: " . $formName . " - Status: " . $id . "<br>";
                            send_report('inspection_emailer', $id, $dealer_id);

                        } else if ($formName == 'EHS Audit') {


                            echo "Form Name: " . $formName . " - Status: " . $id . "<br>";
                            send_report('ehs_emailer', $id, $dealer_id);
                        }
                        else if ($formName == 'Stock Reconciliation') {


                            echo "Form Name: " . $formName . " - Status: " . $id . "<br>";
                            send_report('recon_emailer', $id, $dealer_id);
                        }
                        else if ($formName == 'Fuel Decantation Audit') {


                            echo "Form Name: " . $formName . " - Status: " . $id . "<br>";
                            send_report('fuel_decant_emailer', $id, $dealer_id);
                        }
                        else if ($formName == 'Retailer Profitability') {


                            echo "Form Name: " . $formName . " - Status: " . $id . "<br>";
                            send_report('profitibilty_emailer', $id, $dealer_id);
                        }
                    }
                }
            } else {
                echo "Failed to decode JSON.";
            }
        }

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}

function send_report($links, $task_id, $dealers_id)
{

    $basit = 'abasit9119@gmail.com';
    $ali = 'ali.nazim@cnergyico.com';
    $usman = 'usmanhameed@gmail.com';
    $wasi = 'wasi.shaikh@cnergyico.com';

    $curl = curl_init();

    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'http://151.106.17.246:8080/bycobridgeApis/emailer/' . $links . '.php?dealer_id='.$dealers_id.'&task_id='.$task_id.'&email='.$usman.'',
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
    if ($response != 1) {
        echo 'Report Not Send';
    } else {
        echo 'Report Send';

    }

}

?>