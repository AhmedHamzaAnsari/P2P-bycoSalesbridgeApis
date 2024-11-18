<?php
// fetch.php  
include("../config.php");

$access_key = '03201232927';
$pass = isset($_GET["key"]) ? $_GET["key"] : '';
$pre = isset($_GET["pre"]) ? $_GET["pre"] : '';
$id = isset($_GET["user_id"]) ? intval($_GET["user_id"]) : 0;

if ($pass != '') {
    if ($pass == $access_key) {
        $thread = array();

        if ($pre == 'Admin' || $pre == 'NSM' || $pre == 'GM' || $pre == 'Monit') {
            // Admin/NSM/GM/Monit access query
            $sql_query1 = "
                SELECT *, 
                (SELECT created_at FROM bycobridge.dealer_ledger_log WHERE dealer_id = dl.id order by id desc LIMIT 1) as ledger_update_time 
                FROM dealers as dl 
                WHERE privilege = 'Dealer' 
                ORDER BY dl.id DESC
            ";

            $result1 = mysqli_query($db, $sql_query1);
            if (!$result1) {
                die("Error in SQL Query: " . mysqli_error($db));
            }

            while ($user = mysqli_fetch_assoc($result1)) {
                $thread[] = $user;
            }

        } else {
            // Regular user access query
            if ($id > 0) {
                $sql_query1 = "SELECT * FROM users WHERE dealer_ids != '' AND id = '$id' ORDER BY id DESC";

                $result1 = mysqli_query($db, $sql_query1);
                if (!$result1) {
                    die("Error in SQL Query: " . mysqli_error($db));
                }

                while ($user = mysqli_fetch_assoc($result1)) {
                    $name = $user['name'];
                    $dealers = $user['dealer_ids'];

                    $sql_query2 = " SELECT *, 
                        (SELECT created_at FROM bycobridge.dealer_ledger_log WHERE dealer_id = dl.id order by id desc LIMIT 1) as ledger_update_time 
                        FROM dealers as dl 
                        WHERE dl.id IN($dealers)
                    ";

                    $result2 = mysqli_query($db, $sql_query2);
                    if (!$result2) {
                        die("Error in SQL Query: " . mysqli_error($db));
                    }

                    while ($user2 = mysqli_fetch_assoc($result2)) {
                        $thread[] = $user2;
                    }
                }
            }
        }

        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}
?>
