<?php
// fetch.php  
include ("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"];
$pre = $_GET["pre"];
$id = $_GET["user_id"];

if ($pass != '') {
    if ($pass == $access_key) {
        $thread = array();
        if ($pre == 'Admin' || $pre == 'NSM' || $pre == 'GM') {
            $sql_query1 = "";
            $clause = "";

            if ($pre == 'NSM') {
                $region = $_GET["region"];
                if ($region != "") {
                    $re_region = restring($region);
                    $clause = "AND region IN ($re_region)";
                }
                $sql_query1 = "SELECT * FROM dealers WHERE privilege='Dealer' $clause ORDER BY id DESC;";
            } else {
                $sql_query1 = "SELECT * FROM dealers WHERE privilege='Dealer' ORDER BY id DESC;";
            }

            $result1 = $db->query($sql_query1) or die("Error: " . mysqli_error($db));

            while ($user = $result1->fetch_assoc()) {
                $thread[] = $user;
            }
        } else {
            $sql_query1 = "SELECT * FROM users WHERE dealer_ids != '' AND id='$id' ORDER BY id DESC;";

            $result1 = $db->query($sql_query1) or die("Error: " . mysqli_error($db));

            while ($user = $result1->fetch_assoc()) {
                $dealers = $user['dealer_ids'];

                $sql_query2 = "SELECT * FROM dealers WHERE id IN($dealers);";
                $result2 = $db->query($sql_query2) or die("Error: " . mysqli_error($db));

                while ($dealer = $result2->fetch_assoc()) {
                    $thread[] = $dealer;
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

function restring($string) {
    // Step 1: Split the string into an array
    $array = explode(',', $string);

    // Step 2: Trim whitespace from each element
    $array = array_map('trim', $array);

    // Step 3: Enclose each element in double quotes
    $array = array_map(function ($item) {
        return '"' . $item . '"';
    }, $array);

    // Step 4: Join the array elements back into a string
    return implode(', ', $array);
}
?>