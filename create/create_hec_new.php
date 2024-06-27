<?php
include("../config.php");
session_start();

if (isset($_POST)) {
    $user_id = mysqli_real_escape_string($db, $_POST["user_id"]);
    $response = $_POST["response"];
    $dealer_id = $_POST["dealer_id"];
    $inspection_id = $_POST["inspection_id"];

    $auditor_id = $_POST["auditor_id"];
    $auditor_name = $_POST["auditor_name"];
    $auditor_designation_id = $_POST["auditor_designation_id"];
    $auditor_designation = $_POST["auditor_designation"];
    $audit_date = $_POST["audit_date"];
    $retail_product = $_POST["retail_product"];
    $ug_storage_tanks = $_POST["ug_storage_tanks"];
    $nfr_facilities = $_POST["nfr_facilities"];
    $retail_site_name = $_POST["retail_site_name"];
    $retail_site_id = $_POST["retail_site_id"];
    $location = $_POST["location"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $region = $_POST["region"];
    $last_audit_date = $_POST["last_audit_date"];
    $name_retailer_manager_id = $_POST["name_retailer_manager_id"];
    $name_retailer_manager = $_POST["name_retailer_manager"];
    $dpt_id = $_POST["dpt_id"];
    $form_id = $_POST["form_id"];
    $form_name = $_POST["form_name"];

    $datetime = date('Y-m-d H:i:s');

    $query_main = "INSERT INTO `hec_response_main`
    (`dealer_id`,
    `inspection_id`,
    `data`,
    `created_at`,
    `created_by`,
    `auditor_id`,
    `auditor_name`,
    `auditor_designation_id`,
    `auditor_designation`,
    `audit_date`,
    `retail_product`,
    `ug_storage_tanks`,
    `nfr_facilities`,
    `retail_site_name`,
    `retail_site_id`,
    `location`,
    `address`,
    `city`,
    `province`,
    `region`,
    `last_audit_date`,
    `name_retailer_manager_id`,
    `name_retailer_manager`,
    `dpt_id`,
    `form_id`,
    `form_name`
    )
    VALUES
    ('$dealer_id',
    '$inspection_id',
    '$response',
    '$datetime',
    '$user_id',
    '$auditor_id',
    '$auditor_name',
    '$auditor_designation_id',
    '$auditor_designation',
    '$audit_date',
    '$retail_product',
    '$ug_storage_tanks',
    '$nfr_facilities',
    '$retail_site_name',
    '$retail_site_id',
    '$location',
    '$address',
    '$city',
    '$province',
    '$region',
    '$last_audit_date',
    '$name_retailer_manager_id',
    '$name_retailer_manager',
    '$dpt_id',
    '$form_id',
    '$form_name'
    );";

    if (mysqli_query($db, $query_main)) {
        $active = mysqli_insert_id($db);
        $data = json_decode($response, true);

        // Check if decoding was successful
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "Error decoding JSON: " . json_last_error_msg();
        } else {


            $data = $response;

            $arrayData = json_decode($data, true);

            foreach ($arrayData as $item) {
                foreach ($item as $key => $values) {
                    $category_id = $key;
                    foreach ($values as $innerKey => $innerValues) {
                        // echo "  Inner Key: $innerKey\n";
                        foreach ($innerValues as $innerInnerKey => $innerInnerValue) {
                            $jj = json_encode($innerInnerValue);
                            // echo   $innerInnerKey;
                            $arrayData = json_decode($jj, true);
                            $question_id = $innerInnerKey;
                            $answers = $arrayData['response'];
                            $comment = $arrayData['comment'];

                            // Print response and comment
                            // echo "$category_id:\n";
                            // echo "question_id " . $question_id. "\n";
                            // echo "Response: " . $arrayData['response'] . "\n";
                            // echo "Comment: " . $arrayData['comment'] . "\n";

                            $sql1 = "INSERT INTO `hec_response`
                            (`category_id`,
                            `inspection_id`,
                            `main_id`,
                            `question_id`,
                            `response`,
                            `comment`,
                            `dealer_id`,
                            `created_at`,
                            `created_by`)
                            VALUES
                            ('$category_id',
                            '$inspection_id',
                            '$active',
                            '$question_id',
                            '$answers',
                            '$comment',
                            '$dealer_id',
                            '$datetime',
                            '$user_id');";

                            if (mysqli_query($db, $sql1)) {
                                $sql_check = "SELECT * FROM hec_category_questions where category_id='$category_id' and id='$question_id' and dpt!='' order by id desc";

                                // echo $sql;

                                $result_check = mysqli_query($db, $sql_check);
                                $row_check = mysqli_fetch_array($result_check);

                                $count_check = mysqli_num_rows($result_check);
                                if ($count_check > 0) {
                                    $dpts_ = $row_check['dpt'];
                                    $accelaration = $row_check['answer'];
                                    $inputString = $dpts_;

                                    // Convert the string to an array
                                    $myArray = explode(",", $inputString);

                                    // Print the array using a loop
                                    if ($accelaration == $answers) {
                                        foreach ($myArray as $value) {
                                            // echo $value . "<br>";
                                            $folow_ups = "INSERT INTO `follow_ups`
                                            (`category_id`,
                                            `question_id`,
                                            `answer`,
                                            `task_id`,
                                            `form_id`,
                                            `dpt_id`,
                                            `dpt_users`,
                                            `form_name`,
                                            `response_id`,
                                            `table_name`,
                                            `cat_table`,
                                            `ques_table`,
                                            `created_at`,
                                            `created_by`)
                                            VALUES
                                            ('$category_id',
                                            '$question_id',
                                            '$answers',
                                            '$inspection_id',
                                            '$form_id',
                                            '$dpt_id',
                                            '$value',
                                            '$form_name',
                                            '$active',
                                            'hec_response',
                                            'survey_category',
                                            'survey_category_questions',
                                            '$datetime',
                                            '$user_id');";

                                            if (mysqli_query($db, $folow_ups)) {
                                                $output = 1;
                                            } else {
                                                $output = 0;
                                            }
                                        }

                                    } else {
                                        $output = 1;

                                    }
                                } else {
                                    $output = 1;
                                }

                            } else {
                                $output = 0;
                            }
                        }
                    }
                    // echo "\n";
                }
            }


            echo $output;
            send_email($user_id, $dealer_id, $inspection_id);

        }
    }





}
function send_email($tm_id, $dealer_id, $task_id)
{
    $curl = curl_init();

    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'http://151.106.17.246:8080/bycobridgeApis/emailer/ehs_emailer.php?dealer_id=' . $dealer_id . '&task_id=' . $task_id . '&tm_id=' . $tm_id . '',
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
    // echo $response;
}

?>