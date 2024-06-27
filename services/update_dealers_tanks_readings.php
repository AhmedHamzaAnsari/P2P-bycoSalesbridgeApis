<?php
//fetch.php  
include ("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM bycobridge.dealers_lorries;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $tank_id = $user['id'];
            $dealer_id = $user['dealer_id'];
            $product = $user['product'];

            $sql_query2 = "SELECT * FROM bycobridge.dealer_dip_log where tank_id='$tank_id' and dealer_id='$dealer_id' order by id asc limit 1;";

            $result2 = $db->query($sql_query2) or die("Error :" . mysqli_error($db));

            while ($user2 = $result2->fetch_assoc()) {
                $log_id = $user2['id'];
                $previous_dip = $user2['previous_dip'];
                $current_dip = $user2['current_dip'];
                $old_reading = $user2['old_reading'];
                $current_reading = $user2['current_reading'];
                $datetime = $user2['datetime'];

                echo $datetime . '<br>';

                $update_tank = "UPDATE `bycobridge`.`dealers_lorries`
                SET
                `current_dip` = '$current_dip',
                `current_reading` = '$current_reading',
                `update_time` = '$datetime',
                `created_at` = '$datetime'
                WHERE `id` = '$tank_id' and dealer_id='$dealer_id';";

                if ($db->query($update_tank) === TRUE) {
                    echo 'Update tank table';

                    $sql = "SELECT * FROM bycobridge.dealer_dip_log where tank_id='$tank_id' and dealer_id='$dealer_id' order by id desc limit 1";

                    // echo $sql;

                    $result = mysqli_query($db, $sql);
                    $row = mysqli_fetch_array($result);

                    $first_log_id = $row['id'];

                    $update_tank_log_first = "UPDATE `bycobridge`.`dealer_dip_log`
                    SET
                    `previous_dip` = '$current_dip',
                    `current_dip` = '$current_dip',
                    `old_reading` = '$current_reading',
                    `current_reading` = '$current_reading',
                    `datetime` = '$datetime',
                    `created_at` = '$datetime'
                    WHERE `id` = '$first_log_id' and dealer_id='$dealer_id' and tank_id='$tank_id';";

                    if ($db->query($update_tank_log_first) === TRUE) {
                        echo 'Update First Log';
                    } else {
                        echo 'Error: ' . $db->error . '<br>' . $update_tank_log_first;
                    }



                } else {
                    echo 'Error: ' . $db->error . '<br>' . $query;
                }

            }

        }

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}



?>