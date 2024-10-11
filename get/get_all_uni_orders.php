<?php
//fetch.php  
include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];
// $id=$_GET["id"];
if ($pass != '') {
    if ($pass == $access_key) {
        // $id = $_GET["id"];


        $sql_query1 = "SELECT uo.*,ut.type,geo.name as consignee_name,geo.sap_no as code,vv.name as vendor_name,
        (SELECT  CASE
                WHEN ut.type = 'Pump attendant' THEN size_1 * pump_attendent
                WHEN ut.type = 'Winter Jacket' THEN size_1 * winter_jacket
                WHEN ut.type = 'Bay the Way' THEN size_1 * bay_the_way
            END FROM uni_size where id=5) as ts1
        ,(SELECT CASE
                WHEN ut.type = 'Pump attendant' THEN size_2 * pump_attendent
                WHEN ut.type = 'Winter Jacket' THEN size_2 * winter_jacket
                WHEN ut.type = 'Bay the Way' THEN size_2 * bay_the_way
            END FROM uni_size where id=7) as ts2
        ,(SELECT CASE
                WHEN ut.type = 'Pump attendant' THEN size_3 * pump_attendent
                WHEN ut.type = 'Winter Jacket' THEN size_3 * winter_jacket
                WHEN ut.type = 'Bay the Way' THEN size_3 * bay_the_way
            END FROM uni_size where id=18) as ts3
        ,(SELECT CASE
                WHEN ut.type = 'Pump attendant' THEN size_4 * pump_attendent
                WHEN ut.type = 'Winter Jacket' THEN size_4 * winter_jacket
                WHEN ut.type = 'Bay the Way' THEN size_4 * bay_the_way
            END FROM uni_size where id=19) as ts4
        
        ,(SELECT CASE
                WHEN ut.type = 'Pump attendant' THEN size_1 * pump_attendent
                WHEN ut.type = 'Winter Jacket' THEN size_1 * winter_jacket
                WHEN ut.type = 'Bay the Way' THEN size_1 * bay_the_way
            END  FROM uni_size where id=5)+
        (SELECT CASE
                WHEN ut.type = 'Pump attendant' THEN size_2 * pump_attendent
                WHEN ut.type = 'Winter Jacket' THEN size_2 * winter_jacket
                WHEN ut.type = 'Bay the Way' THEN size_2 * bay_the_way
            END FROM uni_size where id=7)+
        (SELECT CASE
                WHEN ut.type = 'Pump attendant' THEN size_3 * pump_attendent
                WHEN ut.type = 'Winter Jacket' THEN size_3 * winter_jacket
                WHEN ut.type = 'Bay the Way' THEN size_3 * bay_the_way
            END FROM uni_size where id=18)+
        (SELECT CASE
                WHEN ut.type = 'Pump attendant' THEN size_4 * pump_attendent
                WHEN ut.type = 'Winter Jacket' THEN size_4 * winter_jacket
                WHEN ut.type = 'Bay the Way' THEN size_4 * bay_the_way
            END FROM uni_size where id=19) as total_amount
         FROM uni_order as uo 
        left join uni_type as ut on ut.id = uo.type_id 
        left join dealers as geo on geo.id = uo.userid 
        left join vendors as vv on vv.id=uo.vendor
        where uo.type_id!='null'  order by uo.id desc";

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