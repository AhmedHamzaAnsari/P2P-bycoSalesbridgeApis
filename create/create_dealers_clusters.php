<?php
include("../config.php");
session_start();

if (isset($_POST)) {
    $dealer_id = $_POST["dealer_id"];
    $user_id = mysqli_real_escape_string($db, $_POST["user_id"]);
    $gasoline = $_POST["gasoline"];
    $hsd = $_POST["hsd"];
    $motol = $_POST["motol"];
    $cng = $_POST["cng"];
    $remark = $_POST["remark"];
    $response = $_POST["cluster"];


    $datetime = date('Y-m-d H:i:s');

    $query_main = "INSERT INTO `dealers_cluster_main`
    (`dealer_id`,
    `gasoline`,
    `hsd`,
    `motol`,
    `cng`,
    `remark`,
    `created_at`,
    `created_by`)
    VALUES
    ('$dealer_id',
    '$gasoline',
    '$hsd',
    '$motol',
    '$cng',
    '$remark',
    '$datetime',
    '$user_id');";

    if (mysqli_query($db, $query_main)) {
        $active = mysqli_insert_id($db);
        $dataArray = json_decode($response, true);

        if (is_array($dataArray)) {
            // Iterate through the array using a foreach loop
            foreach ($dataArray as $item) {

                $name = $item['name'];
                $omc_id = $item['omc_id'];
                $side = $item['side'];
                $gasoline = $item['gasoline'];
                $hsd = $item['hsd'];
                $motor = $item['motor'];
                $cng = $item['cng'];
                $remark = $item['remark'];
                $coordinates = $item['coordinates'];

                $sql1 = "INSERT INTO `dealers_cluster_sub`
                (`main_id`,
                `name`,
                `omc_id`,
                `side`,
                `gasoline`,
                `hsd`,
                `motor`,
                `cng`,
                `remark`,
                `coordinates`,
                `created_at`,
                `created_by`)
                VALUES
                ('$active',
                '$name',
                '$omc_id',
                '$side',
                '$gasoline',
                '$hsd',
                '$motor',
                '$cng',
                '$remark',
                '$coordinates',
                '$datetime',
                '$user_id');";

                if (mysqli_query($db, $sql1)) {
                    $output = 1;

                }



            }
        } else {
            echo "Failed to decode JSON string.";
        }
    }


echo $output;
}


?>