<?php
include("../../config.php");
session_start();
// error_reporting(E_ALL & ~E_WARNING);

if (isset($_POST)) {
    // ini_set('max_input_vars', 3000);
    $user_id = $_POST['user_id'];
    $dealers = mysqli_real_escape_string($db, $_POST["dealers"]);
    $description = mysqli_real_escape_string($db, $_POST["description"]);


    $userData = count($_POST["dealers_id"]);
    $date = date('Y-m-d H:i:s');

    // echo 'HAmza';
    // print_r( $_POST['text_checkbox']);

    if ($_POST["row_id"] != '') {


    } else {

        $data = getting($dealers,$db);

        for ($i = 0; $i < $userData; $i++) {
            $dealer_checkbox = $_POST['text_checkbox'][$i];
            // echo $dealer_checkbox;

            if ($dealer_checkbox !='0') {
                $inspection_date = $_POST['inspection_date'][$i];
                $pump_id = $_POST['dealers_id'][$i];
                // echo $inspection_date.' '.$pump_id;

                $query = "INSERT INTO `inspector_task`
                (`user_id`,
                `dealer_id`,
                `type`,
                `time`,
                `description`,
                `form_json`,
                `created_at`,
                `created_by`)
                VALUES
                ('$dealers',
                '$pump_id',
                'Inpection',
                '$inspection_date',
                '$description',
                '$data',
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

function getting($id,$db)
{
    $sql_query1 = "SELECT us.*,du.department_id,du.parent_id,du.is_parent,du.name as pre FROM users as us 
    join department_users as du on du.id=us.privilege
    where us.id='$id'";

    $result1 = $db->query($sql_query1) or die("Error :" . mysqli_error($db));

    $thread = array();
    while ($user = $result1->fetch_assoc()) {
        // $thread[] = $user;
        $dpt_id = $user['department_id'];

        $sql_query2 = "SELECT df.*,dt.name as department_name,ip.name AS form_name FROM department_forms as df 
            join department as dt on dt.id=df.department_id
            join inspection_form as ip on ip.id=df.form_id where df.department_id='$dpt_id'";

        $result2 = $db->query($sql_query2) or die("Error :" . mysqli_error($db));

        $forms = array();

        while ($user2 = $result2->fetch_assoc()) {
            // $thread[] = $user;
            $form_id = $user2['form_id'];
            $form_name = $user2['form_name'];

            $forms[] = array(
                "form_id" => $form_id,
                "form_name" => $form_name,
                "status" => 0,
                "Completion_time" => "---",
                "Completion_By" => "---",
            );


        }
        return json_encode($forms);


    }
}
?>