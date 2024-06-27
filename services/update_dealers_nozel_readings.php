<?php
// fetch.php  
include ("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"];

if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM bycobridge.dealers_nozzel;";
        $result1 = $db->query($sql_query1);

        if (!$result1) {
            die("Error: " . $db->error);
        }

        while ($user = $result1->fetch_assoc()) {
            $tank_id = $user['id'];
            $dealer_id = $user['dealer_id'];

            $sql_query2 = "SELECT * FROM bycobridge.dealers_nozzel_readings WHERE nozle_id = '$tank_id' AND dealer_id = '$dealer_id' ORDER BY id ASC LIMIT 1;";
            $result2 = $db->query($sql_query2);

            if (!$result2) {
                die("Error: " . $db->error);
            }

            while ($user2 = $result2->fetch_assoc()) {
                $log_id = $user2['id'];
                $old_reading = $user2['old_reading'];
                $new_reading = $user2['new_reading'];
                $created_at = $user2['created_at'];

                echo $created_at . '<br>';

                $update_tank = "UPDATE `bycobridge`.`dealers_nozzel`
                SET
                    `last_reading` = '$new_reading',
                    `last_date` = '$created_at',
                    `created_at` = '$created_at',
                    `updated_at` = '$created_at'
                WHERE `id` = '$tank_id' AND `dealer_id` = '$dealer_id';";

                if ($db->query($update_tank) === TRUE) {
                    echo 'Update tank table<br>';

                    $sql = "SELECT * FROM bycobridge.dealers_nozzel_readings WHERE nozle_id = '$tank_id' AND dealer_id = '$dealer_id' ORDER BY id DESC LIMIT 1;";
                    $result = $db->query($sql);

                    if (!$result) {
                        die("Error: " . $db->error);
                    }

                    $row = $result->fetch_assoc();
                    $first_log_id = $row['id'];

                    $update_tank_log_first = "UPDATE `bycobridge`.`dealers_nozzel_readings`
                    SET
                        `old_reading` = '$new_reading',
                        `new_reading` = '$new_reading',
                        `created_at` = '$created_at'
                    WHERE `id` = '$first_log_id' AND `dealer_id` = '$dealer_id' AND `nozle_id` = '$tank_id';";

                    if ($db->query($update_tank_log_first) === TRUE) {
                        echo 'Update First Log<br>';
                    } else {
                        echo 'Error: ' . $db->error . '<br>' . $update_tank_log_first;
                    }
                } else {
                    echo 'Error: ' . $db->error . '<br>' . $update_tank;
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
