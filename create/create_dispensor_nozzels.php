<?php
include ("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $dealer_id = mysqli_real_escape_string($db, $_POST["dealer_id"]);
    $dispenser_name = mysqli_real_escape_string($db, $_POST["dispenser_name"]);
    $date = date('Y-m-d H:i:s');

    $userData = count($_POST["name"]);

    // echo 'HAmza';
    if ($_POST["row_id"] != '') {
        $dis_id = $_POST["row_id"];

        // $delete_first = "DELETE FROM dealers_nozzel where dealer_id='$dealer_id' and dispenser_id='$dis_id'";

        // if (mysqli_query($db, $delete_first)) {
            for ($i = 0; $i < $userData; $i++) {
                $name = $_POST['name'][$i];
                $nozzels_products = $_POST['nozzels_products'][$i];
                $product_tank = $_POST['product_tank'][$i];
                $nozzles_ids = $_POST['row_ids'][$i];
                $noz_current_reading = $_POST['noz_current_reading'][$i];
                $nozzle_old_reading = $_POST['nozzle_old_reading'][$i];




                // $query = "INSERT INTO `dealers_nozzel`
                //     (`dealer_id`,
                //     `name`,
                //     `tank_id`,
                //     `products`,
                //     `dispenser_id`,
                //     `created_at`,
                //     `created_by`)
                //     VALUES
                //     ('$dealer_id',
                //     '$name',
                //     '$product_tank',
                //     '$nozzels_products',
                //     '$dis_id',
                //     '$date',
                //     '$user_id');";

                $query = "UPDATE `dealers_nozzel`
                    SET
                    `name` = '$name',
                    `products` = '$nozzels_products',
                    `tank_id` = '$product_tank',
                    `last_reading` = '$noz_current_reading'
                    WHERE `id` = '$nozzles_ids';";


                if (mysqli_query($db, $query)) {


                    // $output = 1;

                    $readings = "INSERT INTO `dealers_nozzel_readings`
                    (`nozle_id`,
                    `dispenser_id`,
                    `dealer_id`,
                    `product_id`,
                    `old_reading`,
                    `new_reading`,
                    `created_at`,
                    `created_by`)
                    VALUES
                    ('$nozzles_ids',
                    '$dis_id',
                    '$dealer_id',
                    '$nozzels_products',
                    '$nozzle_old_reading',
                    '$noz_current_reading',
                    '$date',
                    '$user_id');";
                    if (mysqli_query($db, $readings)) {


                        $output = 1;

                    } else {
                        $output = 'Error' . mysqli_error($db) . '<br>' . $readings;

                    }

                } else {
                    $output = 'Error' . mysqli_error($db) . '<br>' . $query;

                }
            }



        // } else {
        //     $output = 'Error' . mysqli_error($db) . '<br>' . $delete_first;

        // }
        // for ($i = 0; $i < $userData; $i++) {
        //     $name = $_POST['name'][$i];
        //     $nozzels_products = $_POST['nozzels_products'][$i];
        //     $product_tank = $_POST['product_tank'][$i];
        //     $row_ids = $_POST['row_ids'][$i];

        //     $query = "UPDATE `bycobridge`.`dealers_nozzel`
        //     SET
        //     `name` = '$name',
        //     `products` = '$nozzels_products',
        //     `tank_id` = '$product_tank'
        //     WHERE `id` = '$row_ids';";


        //     if (mysqli_query($db, $query)) {


        //         $output = 1;

        //     } else {
        //         $output = 'Error' . mysqli_error($db) . '<br>' . $query;

        //     }
        // }

    } else {

        $query1 = "INSERT INTO `dealers_dispenser`
        (`dealer_id`,
        `name`,
        `description`,
        `created_at`,
        `created_by`)
        VALUES
        ('$dealer_id',
        '$dispenser_name',
        '',
        '$date',
        '$user_id');";


        if (mysqli_query($db, $query1)) {
            $active = mysqli_insert_id($db);

            for ($i = 0; $i < $userData; $i++) {
                $name = $_POST['name'][$i];
                $nozzels_products = $_POST['nozzels_products'][$i];
                $product_tank = $_POST['product_tank'][$i];
                $noz_current_reading = $_POST['noz_current_reading'][$i];

                $query = "INSERT INTO `dealers_nozzel`
                    (`dealer_id`,
                    `name`,
                    `tank_id`,
                    `products`,
                    `dispenser_id`,
                    `last_reading`,
                    `created_at`,
                    `created_by`)
                    VALUES
                    ('$dealer_id',
                    '$name',
                    '$product_tank',
                    '$nozzels_products',
                    '$active',
                    '$noz_current_reading',
                    '$date',
                    '$user_id');";


                if (mysqli_query($db, $query)) {


                    $noz_id = mysqli_insert_id($db);
                    $readings = "INSERT INTO `dealers_nozzel_readings`
                    (`nozle_id`,
                    `dispenser_id`,
                    `dealer_id`,
                    `product_id`,
                    `old_reading`,
                    `new_reading`,
                    `created_at`,
                    `created_by`)
                    VALUES
                    ('$noz_id',
                    '$active',
                    '$dealer_id',
                    '$nozzels_products',
                    '$noz_current_reading',
                    '$noz_current_reading',
                    '$date',
                    '$user_id');";
                    if (mysqli_query($db, $readings)) {


                        $output = 1;

                    } else {
                        $output = 'Error' . mysqli_error($db) . '<br>' . $readings;

                    }

                } else {
                    $output = 'Error' . mysqli_error($db) . '<br>' . $query;

                }
            }
        } else {
            $output = 'Error' . mysqli_error($db) . '<br>' . $query1;

        }


    }



    echo $output;
}
?>