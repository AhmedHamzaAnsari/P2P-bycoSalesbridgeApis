<?php
include("../config.php");
session_start();
if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $category = mysqli_real_escape_string($db, $_POST["category"]);
    $date = date('Y-m-d H:i:s');
    $userData = count($_POST["questions"]);
    // echo 'HAmza';
    if ($_POST["row_id"] != '') {
        $row_id = $_POST['row_id'];
        $category = $_POST['category'];
        $questions = $_POST['questions'];
        $file_req = $_POST['file_req'];
        $answer = $_POST['answer'];
        $dpt = $_POST['selectedValues'];
        $action_time = $_POST['action_time'];

        $query = "UPDATE `retail_category_questions`
                  SET
                  `category_id` = '$category',
                  `question` = '$questions[0]',
                  `file` = '$file_req[0]',
                  `answer` = '$answer[0]',
                  `dpt` = '$dpt[0]',
                  `duration` = '$action_time[0]'
                  WHERE `id` = '$row_id';";

        if (mysqli_query($db, $query)) {
            $output = 1;
        } else {
            $output = 'Error' . mysqli_error($db) . '<br>' . $query;
        }

    } else {


        for ($i = 0; $i < $userData; $i++) {

            $questions = $_POST['questions'][$i];
            $file_req = $_POST['file_req'][$i];
            $answer = $_POST['answer'][$i];
            $action_time = $_POST['action_time'][$i];
            $dpt = $_POST['selectedValues'][$i];

            $query_count = "INSERT INTO `retail_category_questions`
            (`category_id`,
            `question`,
            `file`,
            `answer`,
            `dpt`,
            `duration`,
            `created_at`,
            `created_by`)
            VALUES
            ('$category',
            '$questions',
            '$file_req',
            '$answer',
            '$dpt',
            '$action_time',
            '$date',
            '$user_id');";
            if (mysqli_query($db, $query_count)) {
                $output = 1;

            }else {
                $output = 'Error' . mysqli_error($db) . '<br>' . $query_count;
    
            }

        }

        
    }



    echo $output;
}
?>