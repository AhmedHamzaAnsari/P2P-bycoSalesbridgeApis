<?php
//fetch.php  
include("../config.php");
ini_set('max_execution_time', 500); // 300 seconds = 5 minutes


$access_key = '03201232927';

$pass = $_GET["key"];
$date = date('Y-m-d H:i:s');
if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT * FROM bycobridge.dealers;";

        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $thread = array();
        while ($user = $result1->fetch_assoc()) {

            $dealers_id = $user['id'];
            $sap_no = $user['sap_no'];

            $sql_query = "SELECT sd.*,geo.id as depot_id,dl.id as dealer_id FROM bycobridge.sap_depot as sd 
            join geofenceing as geo on geo.consignee_name=sd.depot 
            join dealers as dl on dl.sap_no=sd.sapcode
            where sd.sapcode='$sap_no';";

            $result = $db->query($sql_query) or die("Error :" . mysqli_error());


            while ($row = $result->fetch_assoc()) {

                $depot_id = $row['depot_id'];
                $dealer_id = $row['dealer_id'];


                    $query = "INSERT INTO `bycobridge`.`dealers_depots`
                    (`dealers_id`,
                    `depot_id`,
                    `created_at`,
                    `created_by`)
                    VALUES
                    ('$dealer_id',
                    '$depot_id',
                    '$date',
                    '1');";
                    mysqli_query($db, $query);

               
                


            }

        }


    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>