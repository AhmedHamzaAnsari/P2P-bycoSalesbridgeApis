<?php
include ("../config.php");
session_start();
if (isset($_POST)) {


    $row_id = $_POST['row_id'];
    $category_id = $_POST['category_id'];
    $question = $_POST['question'];
    $file = $_POST['file'];
    $answer = $_POST['answer'];
    $dpt = $_POST['dpt'];
    $duration = $_POST['duration'];

    // echo 'HAmza';



    $query = "UPDATE `survey_category_questions`
    SET
    `category_id` = '$category_id',
    `question` = '$question',
    `file` = '$file',
    `answer` = '$answer',
    `dpt` = '$dpt',
    `duration` = '$duration'
    WHERE `id` = '$row_id';";


    if (mysqli_query($db, $query)) {

        $output = 1;
    } else {
        $output = 'Error' . mysqli_error($db) . '<br>' . $query;

    }




    echo $output;
}
?>