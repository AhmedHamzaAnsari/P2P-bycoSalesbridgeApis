<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $dealer_id = $_POST['dealer_id'];
    $datetime = date('Y-m-d H:i:s');

    $cf_total = $_POST["cf_total"];
    $sf_total = $_POST["sf_total"];
    $df_total = $_POST["df_total"];
    $task_id = $_POST["task_id"];
    $form_id = $_POST["form_id"];

    $product = $_POST["data"];

    if ($product != '') {
        if ($_POST["row_id"] != '') {


        } else {


            $query_main = "INSERT INTO `dealers_profitability_main`
            (`cf_total`,
            `sf_total`,
            `df_total`,
            `dealer_id`,
            `task_id`,
            `form_id`,
            `created_at`,
            `created_by`)
            VALUES
            ('$cf_total',
            '$sf_total',
            '$df_total',
            '$dealer_id',
            '$task_id',
            '$form_id',
            '$datetime',
            '$user_id');";

            if (mysqli_query($db, $query_main)) {
                $active = mysqli_insert_id($db);

                $dataArray = json_decode($product, true);

                // Check if the decoding was successful
                if (is_array($dataArray)) {
                    // Iterate through the array using a foreach loop
                    foreach ($dataArray as $item) {


                        $retailer_profitability = $item['retailer_profitability'];
                        $cf = $item['cf'];
                        $sf = $item['sf'];
                        $df = $item['df'];

                        $sql1 = "INSERT INTO `dealers_profitability`
                            (`main_id`,
                            `dealer_id`,
                            `retailer_profitability`,
                            `cf`,
                            `sf`,
                            `df`,
                            `created_at`,
                            `created_by`)
                            VALUES
                            ('$active',
                            '$dealer_id',
                            '$retailer_profitability',
                            '$cf',
                            '$sf',
                            '$df',
                            '$datetime',
                            '$user_id');";

                        if (mysqli_query($db, $sql1)) {
                            $output = 1;

                        }



                    }
                } else {
                    echo "Failed to decode JSON string.";
                }




            } else {
                $output = 'Error' . mysqli_error($db) . '<br>' . $query_main;

            }
        }

    } else {
        $output = 0;
    }




    echo $output;
}
?>