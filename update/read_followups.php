<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    // Existing code...
    $pre = $_GET['pre'];
    
    if ($pre != 'Admin') {
        $dpt_id = $_GET['dpt_id'];
        $query = "UPDATE bycobridge.followup_notification nn
        JOIN follow_ups fu ON fu.id = nn.followup_id
        SET nn.status = 1
        WHERE fu.dpt_id = $dpt_id AND nn.status = 0;";

    }else{
        $query = "UPDATE bycobridge.followup_notification nn
        JOIN follow_ups fu ON fu.id = nn.followup_id
        SET nn.status = 1
        WHERE nn.status = 0;";
    }




    mysqli_query($db, $query);

    echo 1;
}