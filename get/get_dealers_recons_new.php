<?php
//fetch.php  
include ("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"];

if (!empty($pass)) {
    if ($pass == $access_key) {
        $dealer_id = intval($_GET["dealer_id"]);
        $from = $db->real_escape_string($_GET["from"]);
        $to = $db->real_escape_string($_GET["to"]);

        // Initialize an array to store the data
        $formatted_data = [];

        // Query to fetch records
        $sql = "SELECT it.*,dl.name as dealer_name,dl.terr,dl.region,us.name as tm_name FROM bycobridge.inspector_task as it
        join dealers as dl on dl.id=it.dealer_id
        join users as us on us.id=it.user_id
                WHERE dl.id = $dealer_id 
                AND DATE(it.time) >= '$from' 
                AND DATE(it.time) <= '$to';";

        $result = $db->query($sql);

        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $name = $row["dealer_name"];
            $terr = $row["terr"];
            $region = $row["region"];
            $tm_name = $row["tm_name"];

            $jsonStringmain = $row["form_json"];

            // Decode JSON string into an array
            $data_main = json_decode($jsonStringmain, true);

            // Check if json_decode returned an array
            if (is_array($data_main)) {
                // Initialize an array to hold filtered items
                $filteredData = array();

                // Iterate through each item in the array
                foreach ($data_main as $item) {
                    // Check if the form_name is 'Inspection'
                    if ($item['form_name'] === 'Stock Reconciliation') {

                        if ($item['status'] == 1) {
                            // Initialize formatted data for this record
                            $record_data = [
                                'site' => $name,
                                'tm' => $tm_name,
                                'territory' => $terr,
                                'region' => $region,
                                'opening_date' => '',
                                'closing_date' => '',
                                'no_os_days' => '0',
                                'diesel_daily_sales' => '0',
                                'diesel_opening_stock' => '0',
                                'diesel_receipts' => '0',
                                'diesel_sales' => '0',
                                'diesel_book_stock' => '0',
                                'diesel_variance' => '0',
                                'diesel_variance_percentage' => '0',
                                'diesel_remark' => '',
                                'gasoline_daily_sales' => '0',
                                'gasoline_opening_stock' => '0',
                                'gasoline_receipts' => '0',
                                'gasoline_sales' => '0',
                                'gasoline_book_stock' => '0',
                                'gasoline_variance' => '0',
                                'gasoline_variance_percentage' => '0',
                                'gasoline_remark' => '',
                                'gasoline95_daily_sales' => '0',
                                'gasoline95_opening_stock' => '0',
                                'gasoline95_receipts' => '0',
                                'gasoline95_sales' => '0',
                                'gasoline95_book_stock' => '0',
                                'gasoline95_variance' => '0',
                                'gasoline95_variance_percentage' => '0',
                                'gasoline95_remark' => '',
                                'comments' => '',  // Assuming comments are fetched separately or added manually
                                'hsd' => '',  // Assuming HSD data is fetched separately or calculated
                                'pmg' => '',  // Assuming PMG data is fetched separately or calculated
                            ];

                            // Query to get stock recon data
                            $get_orders = "SELECT rs.*, pp.name as product_name
                            FROM dealer_stock_recon_new as rs
                            JOIN all_products as pp ON pp.id = rs.product_id
                            WHERE rs.task_id = $id 
                            GROUP BY rs.product_id, rs.task_id";

                            $result_orders = $db->query($get_orders);

                            while ($row_2 = $result_orders->fetch_assoc()) {
                                $product_name = $row_2['product_name'];

                                if ($product_name == 'HSD') {
                                    $record_data['diesel_opening_stock'] = $row_2['sum_of_opening'];
                                    $record_data['diesel_receipts'] = $row_2['total_recipt'];
                                    $record_data['diesel_sales'] = $row_2['total_sales'];
                                    $record_data['diesel_book_stock'] = $row_2['book_value'];
                                    $record_data['diesel_variance'] = $row_2['variance'];
                                    $record_data['diesel_variance_percentage'] = round($row_2['variance_of_sales'], 2);
                                    $record_data['hsd'] = ''; // Store the full row if needed
                                    $record_data['no_os_days'] = $row_2['total_days']; // Store the full row if needed
                                    $record_data['opening_date'] = $row_2['last_recon_date']; // Store the full row if needed
                                    $record_data['closing_date'] = $row_2['created_at']; // Store the full row if needed
                                    $record_data['diesel_daily_sales'] = round($row_2['average_daily_sales'], 2) ; // Store the full row if needed
                                    $record_data['diesel_remark'] = $row_2['remark']; // Store the full row if needed
                                }

                                if ($product_name == 'PMG') {
                                    $record_data['gasoline_opening_stock'] = $row_2['sum_of_opening'];
                                    $record_data['gasoline_receipts'] = $row_2['total_recipt'];
                                    $record_data['gasoline_sales'] = $row_2['total_sales'];
                                    $record_data['gasoline_book_stock'] = $row_2['book_value'];
                                    $record_data['gasoline_variance'] = $row_2['variance'];
                                    $record_data['gasoline_variance_percentage'] = round($row_2['variance_of_sales'], 2);
                                    $record_data['pmg'] = ''; // Store the full row if needed
                                    $record_data['no_os_days'] = $row_2['total_days']; // Store the full row if needed
                                    $record_data['opening_date'] = $row_2['last_recon_date']; // Store the full row if needed
                                    $record_data['closing_date'] = $row_2['created_at'];
                                    $record_data['gasoline_daily_sales'] = round($row_2['average_daily_sales'], 2); // Store the full row if needed
                                    $record_data['gasoline_remark'] = $row_2['remark']; // Store the full row if needed



                                }
                                
                                if ($product_name == 'Gasoline 95') {
                                    $record_data['gasoline95_opening_stock'] = $row_2['sum_of_opening'];
                                    $record_data['gasoline95_receipts'] = $row_2['total_recipt'];
                                    $record_data['gasoline95_sales'] = $row_2['total_sales'];
                                    $record_data['gasoline95_book_stock'] = $row_2['book_value'];
                                    $record_data['gasoline95_variance'] = $row_2['variance'];
                                    $record_data['gasoline95_variance_percentage'] = round($row_2['variance_of_sales'], 2);
                                    $record_data['pmg'] = ''; // Store the full row if needed
                                    $record_data['no_os_days'] = $row_2['total_days']; // Store the full row if needed
                                    $record_data['opening_date'] = $row_2['last_recon_date']; // Store the full row if needed
                                    $record_data['closing_date'] = $row_2['created_at'];
                                    $record_data['gasoline95_daily_sales'] = round($row_2['average_daily_sales'], 2); // Store the full row if needed
                                    $record_data['gasoline95_remark'] = $row_2['remark']; // Store the full row if needed



                                }
                            }
                            

                            // Append the formatted record data to the array
                            $formatted_data[] = $record_data;
                        }
                    }
                }

                // Encode the filtered array back to JSON
                $filteredJsonString = json_encode($filteredData, JSON_PRETTY_PRINT);

                // Output the filtered JSON string
                // echo $filteredJsonString;
            } else {
                echo "Failed to decode JSON.";
            }




        }

        // Convert the array to a JSON string
        $jsonData = json_encode($formatted_data);

        // Output the JSON string
        echo $jsonData;

    } else {
        echo 'Wrong Key...';
    }
} else {
    echo 'Key is Required';
}
?>