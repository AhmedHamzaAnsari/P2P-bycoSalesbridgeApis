<?php
include("../../config.php");
session_start();
if (isset($_POST)) {



    $task_id = $_POST['task_id'];
    $form_id = $_POST['form_id'];






    $datetime = date('Y-m-d H:i:s');

    // echo 'HAmza';

    $update_json = getting($task_id,$db,$form_id);
    // echo $update_json;
    $query = "UPDATE `inspector_task` SET 
    `form_json`= '$update_json'
    WHERE id=$task_id";


    if (mysqli_query($db, $query)) {
        $output = 1;

    } else {
        $output = 'Error' . mysqli_error($db) . '<br>' . $query;

    }




    echo $output;
}

function getting($task_id,$db,$form_id)
{
    $datetime = date('Y-m-d H:i:s');
    $sql_query1 = "SELECT * FROM inspector_task where id='$task_id'";

    $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

    $thread = array();
    while ($user = $result1->fetch_assoc()) {
        // $thread[] = $user;
        $form_json = $user['form_json'];
        // echo $form_json;
        $data = json_decode($form_json, true);

        // Find the index of the element with form_id equal to 4
        $index = array_search($form_id, array_column($data, 'form_id'));
        
        // Update the status to 1 if the element is found
        if ($index !== false) {
            $data[$index]['status'] = 1;
            $data[$index]['Completion_time'] = $datetime;
        }
        
        // Print the updated array
        return json_encode($data);



    }
}
?>