<?php
include("../config.php");
// session_start();


if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    $nozel_counts = count($_POST['nozzels_id']);
    $all_dpt = mysqli_real_escape_string($db, $_POST["all_dpt"]);
    $date = date('Y-m-d H:i:s');
    $output = '';
    // echo 'HAmza';
    if ($_POST["row_id"] != '') {


    } else {

        if ($nozel_counts > 0) {
            for ($i = 0; $i < $nozel_counts; $i++) {
                $form_id = $_POST["nozzels_id"][$i];

                $query = "INSERT INTO `department_forms`
                (`department_id`,
                `form_id`,
                `status`,
                `created_at`,
                `created_by`)
                VALUES
                ('$all_dpt',
                '$form_id',
                '1',
                '$date',
                '$user_id');";
                if (mysqli_query($db, $query)) {



                    $output = 1;

                } else {
                    $output = 'Error' . mysqli_error($db) . '<br>' . $query;

                }
            }
        }
        





    }



    echo $output;
}
?>