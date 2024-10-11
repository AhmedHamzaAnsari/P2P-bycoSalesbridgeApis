<?php
include("../../config.php");
session_start();
set_time_limit(0); // Set execution time limit to unlimited

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $date = date('Y-m-d H:i:s');

    // Check if the CSV file is uploaded
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {

        // Get the uploaded file's temporary path
        $fileName = $_FILES['csv_file']['tmp_name'];

        // Check if the uploaded file is a CSV file
        if ($_FILES['csv_file']['type'] === 'text/csv' || mime_content_type($fileName) === 'text/plain') {

            // Open the CSV file
            if (($handle = fopen($fileName, "r")) !== FALSE) {

                // Skip the header row
                fgetcsv($handle);

                $success = true; // Initialize success flag
                $errors = []; // Initialize errors array

                // Loop through each row in the CSV file
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // Extract data from CSV row
                    $dealer_name = $data[1];
                    $dealerr_code = $data[2];
                    $product = $data[3];
                    $freight = $data[4];
                    $indent_price = $data[5];
                    $nozel_price = $data[6];
                    $from_date = $data[7];
                    $to_date = $data[8];

                    // SQL query to fetch dealer and product IDs
                    $sql = "SELECT dl.id as dealer_id, dp.id as dealer_product_id 
                            FROM bycobridge.dealers_products as dp
                            JOIN dealers as dl ON dl.id = dp.dealer_id 
                            JOIN all_products as pp ON pp.id = dp.name
                            WHERE dl.sap_no = '$dealerr_code' AND pp.name = '$product'";

                    // Execute the query
                    $result = mysqli_query($db, $sql);
                    if ($result) {
                        $row = mysqli_fetch_array($result);
                        $count = mysqli_num_rows($result);

                        if ($count > 0) {
                            $dealer_id = $row['dealer_id'];
                            $dealer_product_id = $row['dealer_product_id'];

                            // Update query for dealers_products
                            $query = "UPDATE `dealers_products`
                                      SET 
                                      `from` = '$from_date',
                                      `to` = '$to_date',
                                      `freight` = '$freight',
                                      `indent_price` = '$indent_price',
                                      `nozel_price` = '$nozel_price',
                                      `update_time` = '$date'
                                      WHERE `id` = $dealer_product_id";

                            // Execute the update query
                            if (!mysqli_query($db, $query)) {
                                $errors[] = 'Error updating product ID ' . $dealer_product_id . ': ' . mysqli_error($db);
                                $success = false; // Set success to false
                            } else {
                                // Insert query for dealer_nozel_price_log
                                $backlog = "INSERT INTO `dealer_nozel_price_log`
                                            (`dealer_id`,
                                             `product_id`,
                                             `indent_price`,
                                             `nozel_price`,
                                             `freight`,
                                             `from`,
                                             `to`,
                                             `description`,
                                             `created_at`,
                                             `created_by`)
                                            VALUES
                                            ('$dealer_id',
                                             '$dealer_product_id',
                                             '$indent_price',
                                             '$nozel_price',
                                             '$freight',
                                             '$from_date',
                                             '$to_date',
                                             'Update through importer',
                                             '$date',
                                             '$user_id')";

                                // Execute the insert query
                                if (!mysqli_query($db, $backlog)) {
                                    $errors[] = 'Error logging update for product ID ' . $dealer_product_id . ': ' . mysqli_error($db);
                                    $success = false; // Set success to false
                                }
                            }
                        }
                    } else {
                        $errors[] = 'Error executing query: ' . mysqli_error($db);
                        $success = false; // Set success to false
                    }
                }

                // Close the file handle
                fclose($handle);

                // Prepare response
                if ($success) {
                    echo json_encode(["status" => "success", "message" => "File uploaded and data inserted successfully!"]);
                } else {
                    echo json_encode(["status" => "error", "errors" => $errors]);
                }

            } else {
                echo json_encode(["status" => "error", "message" => "Error opening the file."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Please upload a valid CSV file."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No file uploaded or there was an error uploading the file."]);
    }

    // Close the database connection
    $db->close();
}
?>
