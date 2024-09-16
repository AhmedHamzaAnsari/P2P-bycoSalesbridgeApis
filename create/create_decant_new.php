<?php
include("../config.php");
session_start();

if (isset($_POST)) {
    $user_id = mysqli_real_escape_string($db, $_POST["user_id"]);
    $response = $_POST["response"];
    $dealer_id = $_POST["dealer_id"];
    $inspection_id = $_POST["inspection_id"];
    $site_name = $_POST["site_name"];
    $header_name = $_POST["header_name"];

    $dpt_id = $_POST["dpt_id"];
    $form_id = $_POST["form_id"];


    $datetime = date('Y-m-d H:i:s');

    $query_main = "INSERT INTO `decant_response_main`
    (`inspection_id`,
    `dealer_id`,
    `data`,
    `site_name`,
    `header_data`,
    `dpt_id`,
    `form_id`,
    `created_at`,
    `created_by`
    )
    VALUES
    (
    '$inspection_id',
    '$dealer_id',
    '$response',
    '$site_name',
    '$header_name',
    '$dpt_id',
    '$form_id',
    '$datetime',
    '$user_id'
    );";

    if (mysqli_query($db, $query_main)) {
        $active = mysqli_insert_id($db);
        $data = json_decode($response, true);

        // Check if decoding was successful
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo "Error decoding JSON: " . json_last_error_msg();
        } else {

            // Iterate through the outer array
            // foreach ($data as $section) {
            //     // Iterate through the inner arrays
            //     foreach ($section as $area => $questions) {
            //         $category_id = $area;
            //         // echo "$category_id:\n";

            //         // Iterate through the questions
            //         foreach ($questions as $question) {
            //             // Print each question and its value
            //             foreach ($question as $q => $value) {
            //                 $question_id = $q;
            //                 $answers = $value;

            //                 // echo $category_id . ' => ' . "  $question_id: $answers\n";

            //                 $sql1 = "INSERT INTO `survey_response`
            //                 (`category_id`,
            //                 `inspection_id`,
            //                 `main_id`,
            //                 `question_id`,
            //                 `response`,
            //                 `comment`,
            //                 `dealer_id`,
            //                 `created_at`,
            //                 `created_by`)
            //                 VALUES
            //                 ('$category_id',
            //                 '$inspection_id',
            //                 '$active',
            //                 '$question_id',
            //                 '$answers',
            //                 '',
            //                 '$dealer_id',
            //                 '$datetime',
            //                 '$user_id');";

            //                 if (mysqli_query($db, $sql1)) {
            //                     $output = 1;

            //                 } else {
            //                     $output = 0;
            //                 }
            //             }
            //         }
            //     }
            // }
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

                            $sql1 = "INSERT INTO `decant_response`
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
                                $output = 1;

                            } else {
                                $output = 0;
                            }
                        }
                    }
                    // echo "\n";
                }
            }


            echo $output;
            // send_email($user_id, $dealer_id, $inspection_id);

        }
    }





}
function send_email($tm_id, $dealer_id, $task_id)
{
    $curl = curl_init();

    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'http://151.106.17.246:8080/bycobridgeApis/emailer/fuel_decant_emailer.php?dealer_id=' . $dealer_id . '&task_id=' . $task_id . '&tm_id=' . $tm_id . '',
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