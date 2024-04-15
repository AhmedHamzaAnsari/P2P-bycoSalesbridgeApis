<?php  



include("../config.php");


$access_key = '03201232927';

$pass = $_GET["key"];

if ($pass != '') {
    if ($pass == $access_key) {
        $sql_query1 = "SELECT DISTINCT district FROM `dealers`;";

        $result1 = $db->query($sql_query1) or die ("Error :".mysqli_error($db));

        $district = array();
        while($district1 = $result1->fetch_assoc()) {
        $district[] = $district1;
        }


        $sql_query = "SELECT DISTINCT city FROM `dealers`";

        $result2 = $db->query($sql_query) or die ("Error :".mysqli_error($db));
   
        $city = array();
        while($city1 = $result2->fetch_assoc()) {
        $city[] = $city1;
        }

        $sql_query2 = "SELECT DISTINCT province FROM `dealers`";

        $result3 = $db->query($sql_query2) or die ("Error :".mysqli_error($db));
   
        $province = array();
        while($province1 = $result3->fetch_assoc()) {
        $province[] = $province1;
        }
        $sql_query3 = "SELECT DISTINCT region FROM `dealers`";

        $result4 = $db->query($sql_query3) or die ("Error :".mysqli_error($db));
   
        $region = array();
        while($region1 = $result4->fetch_assoc()) {
        $region[] = $region1;
        }

        $sql_query5 = "SELECT DISTINCT terr FROM `dealers`";

        $result5 = $db->query($sql_query5) or die ("Error :".mysqli_error($db));
   
        $terr = array();
        while($region5 = $result5->fetch_assoc()) {
        $terr[] = $region5;
        }

        $sql_query6 = "SELECT DISTINCT actual_depot FROM `dealers`";

        $result6 = $db->query($sql_query6) or die ("Error :".mysqli_error($db));
   
        $actual_depot = array();
        while($region6 = $result6->fetch_assoc()) {
        $actual_depot[] = $region6;
        }

        $sql_query7 = "SELECT DISTINCT cat_1 FROM `dealers`";

        $result7 = $db->query($sql_query7) or die ("Error :".mysqli_error($db));
   
        $cat_1 = array();
        while($region7 = $result7->fetch_assoc()) {
        $cat_1[] = $region7;
        }

        $sql_query8 = "SELECT DISTINCT finance FROM `dealers`";

        $result8 = $db->query($sql_query8) or die ("Error :".mysqli_error($db));
   
        $finance = array();
        while($region8 = $result8->fetch_assoc()) {
        $finance[] = $region8;
        }

        $sql_query9 = "SELECT * FROM `department`";

        $result9 = $db->query($sql_query9) or die ("Error :".mysqli_error($db));
   
        $dpts = array();
        while($region9 = $result9->fetch_assoc()) {
        $dpts[] = $region9;
        }
        

        // print_r($itmes);


      $data[] = array(
      'district' => json_encode($district),
      'city' => json_encode($city),
      'province' => json_encode($province),
      'region' => json_encode($region),
      'terr' => json_encode($terr),
      'actual_depot' => json_encode($actual_depot),
      'cat_1' => json_encode($cat_1),
      'finance' => json_encode($finance),
      'dpts' => json_encode($dpts)
    );    

    echo json_encode($data); 
    } else {
        echo 'Wrong Key...';
    }

} else {
    echo 'Key is Required';
}


?>
