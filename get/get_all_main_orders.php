<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
$pre = $_GET["pre"];
$id = $_GET["user_id"];
if ($pass != '') {
    if ($pass == $access_key) {

        if ($pre == 'ZM') {

            $sql_query1 = "SELECT om.*,geo.consignee_name,dl.name ,dl.zm,dl.tm,dl.asm,
            CASE
                    WHEN om.status = 0 THEN 'Pending'
                    WHEN om.status = 1 THEN 'Approved'
                    WHEN om.status = 2 THEN 'Complete'
                    WHEN om.status = 3 THEN 'Cancel'
                    WHEN om.status = 4 THEN 'Special Approval'
                    WHEN om.status = 5 THEN 'ASM Approved'
                END AS current_status
            FROM order_main as om 
           left join geofenceing as geo on geo.id=om.depot
            join dealers as dl on dl.id=om.created_by 
            where om.status IN(0,5) and dl.zm=$id order by om.id desc";
        } elseif ($pre == 'TM') {

            $sql_query1 = "SELECT om.*,geo.consignee_name,dl.name ,dl.zm,dl.tm,dl.asm,
            CASE
                    WHEN om.status = 0 THEN 'Pending'
                    WHEN om.status = 1 THEN 'Approved'
                    WHEN om.status = 2 THEN 'Complete'
                    WHEN om.status = 3 THEN 'Cancel'
                    WHEN om.status = 4 THEN 'Special Approval'
                    WHEN om.status = 5 THEN 'ASM Approved'
                END AS current_status
            FROM order_main as om 
           left join geofenceing as geo on geo.id=om.depot
            join dealers as dl on dl.id=om.created_by 
            where om.status IN(0,5) and dl.tm=$id order by om.id desc";
        } elseif ($pre == 'ASM') {
            $sql_query1 = "SELECT om.*,geo.consignee_name,dl.name ,dl.zm,dl.tm,dl.asm,
            CASE
                    WHEN om.status = 0 THEN 'Pending'
                    WHEN om.status = 1 THEN 'Approved'
                    WHEN om.status = 2 THEN 'Complete'
                    WHEN om.status = 3 THEN 'Cancel'
                    WHEN om.status = 4 THEN 'Special Approval'
                    WHEN om.status = 5 THEN 'ASM Approved'
                END AS current_status
            FROM order_main as om 
           left join geofenceing as geo on geo.id=om.depot
            join dealers as dl on dl.id=om.created_by 
            where om.status IN(0,5) and dl.asm=$id order by om.id desc";

        } else {

            $sql_query1 = "SELECT om.*,geo.consignee_name,dl.name ,dl.zm,dl.tm,dl.asm,
            CASE
                    WHEN om.status = 0 THEN 'Pending'
                    WHEN om.status = 1 THEN 'Approved'
                    WHEN om.status = 2 THEN 'Complete'
                    WHEN om.status = 3 THEN 'Cancel'
                    WHEN om.status = 4 THEN 'Special Approval'
                    WHEN om.status = 5 THEN 'ASM Approved'
                END AS current_status
            FROM order_main as om 
           left join geofenceing as geo on geo.id=om.depot
            join dealers as dl on dl.id=om.created_by 
            where om.status IN(0,5) order by om.id desc;";
        }


        $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error());

        $thread = array();
        while ($user = $result1->fetch_assoc()) {
            $thread[] = $user;
        }
        echo json_encode($thread);

    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>