<?php
// fetch.php  
include ("../config.php");

$access_key = '03201232927';

$pass = $_GET["key"];
if ($pass != '') {
    if ($pass == $access_key) {

        $dealer_id = $_GET["dealer_id"];
        $from = $_GET["from"];
        $to = $_GET["to"];

        // Initialize an array to store the data
        $data = [];

        $sql = "SELECT pd.*, pp.name as product_name 
                FROM dealers_products as pd 
                JOIN all_products as pp ON pp.id = pd.name
                WHERE pd.dealer_id = $dealer_id;";
        $result = $db->query($sql);

        // Function to find the tank data by id in an array
        function find_data_by_id($array, $id)
        {
            foreach ($array as $item) {
                if ($item['id'] == $id) {
                    return $item;
                }
            }
            return null;
        }

        while ($row = $result->fetch_assoc()) {
            $product_id = $row["name"];
            $product_name = $row["product_name"];
            $tank_data_array = [];
            $nozzels_data_array = [];

            $get_orders = "SELECT rr.*, pp.name as product_name, dc.name as dealer_name 
                           FROM dealer_stock_recon_new as rr
                           JOIN all_products as pp ON pp.id = rr.product_id
                           JOIN dealers as dc ON dc.id = rr.dealer_id 
                           WHERE rr.dealer_id = $dealer_id AND DATE(rr.created_at) >= '$from' 
                           AND DATE(rr.created_at) <= '$to' AND rr.product_id = $product_id";

            $result_orders = $db->query($get_orders);
            $sum_of_opening = 0;
            $sum_of_closing = 0;
            $sum_of_nozel_sales = 0;
            $sum_of_total_recipt = 0;
            $sum_of_total_book_value = 0;
            $ind = 0;


            $orders = [];
            while ($row_2 = $result_orders->fetch_assoc()) {
                $orders[] = $row_2;

                $total_recipt = is_numeric($row_2['total_recipt']) ? $row_2['total_recipt'] : 0;
                $book_value = is_numeric($row_2['book_value']) ? $row_2['book_value'] : 0;

                $sum_of_total_recipt += $total_recipt;
                $sum_of_total_book_value += $book_value;
            }

            $first_row = '';
            $last_row = '';

            $first_row_nozel = '';
            $last_row_nozel = '';



            // Get the count of orders
            $orders_count = count($orders);

            // Save first and last row
            if ($orders_count > 0) {
                $first_row = $orders[0];
                $last_row = $orders[$orders_count - 1];
            }

            $tanks_data_first = $first_row['tanks'];
            $tanks_data_last = $last_row['tanks'];

            $first_data_array = json_decode($tanks_data_first, true);
            $last_data_array = json_decode($tanks_data_last, true);

            // Create an associative array to hold the final tank data
            $tank_data_array = [];

            // Iterate through the first data array to build the final tank data array
            foreach ($first_data_array as $first_tank_data) {
                $tank_id = $first_tank_data['id'];
                $tank_name = $first_tank_data['name'];
                $opening = $first_tank_data['opening'];
                $opening_dip = $first_tank_data['opening_dip'];

                // Find the corresponding last data for this tank
                $last_tank_data = find_data_by_id($last_data_array, $tank_id);

                if ($last_tank_data) {
                    $closing = $last_tank_data['closing'];
                    $closing_dip = $last_tank_data['closing_dip'];

                    // Build the tank data array for this tank
                    $tank_data_array[$tank_id] = array(
                        'id' => $tank_id,
                        'name' => $tank_name,
                        'opening' => $opening,
                        'closing' => $closing,
                        'opening_dip' => $opening_dip,
                        'closing_dip' => $closing_dip
                    );
                }
            }

            // Re-index the arrays to remove IDs as keys
            $nozzles_data_first = $first_row['nozzel'];
            $nozzles_data_last = $last_row['nozzel'];

            $first_nozzle_data_array = json_decode($nozzles_data_first, true);
            $last_nozzle_data_array = json_decode($nozzles_data_last, true);

            $nozzles_data_array = [];

            foreach ($first_nozzle_data_array as $first_nozzle_data) {
                $nozzle_id = $first_nozzle_data['id'];
                $nozzle_name = $first_nozzle_data['name'];
                $opening = $first_nozzle_data['opening'];
                $closing = $first_nozzle_data['closing'];
                // $dispencer_id = $first_nozzle_data['dispencer_id'];
                // $dispenser_name = $first_nozzle_data['dispenser_name'];

                $last_nozzle_data = find_data_by_id($last_nozzle_data_array, $nozzle_id);

                if ($last_nozzle_data) {
                    $closing = $last_nozzle_data['closing'];
                    $dispencer_id = $last_nozzle_data['dispencer_id'];
                $dispenser_name = $last_nozzle_data['dispenser_name'];

                    $nozzles_data_array[$nozzle_id] = array(
                        'id' => $nozzle_id,
                        'name' => $nozzle_name,
                        'opening' => $opening,
                        'closing' => $closing,
                        'dispencer_id' => $dispencer_id,
                        'dispenser_name' => $dispenser_name
                    );
                }
            }

            // Re-index the arrays to remove IDs as keys
            $tank_data_array = array_values($tank_data_array);
            $nozzles_data_array = array_values($nozzles_data_array);


            // echo json_encode($tank_data_array);


            // Initialize sum variable
            $sum_of_opening = 0;
            $sum_of_closing = 0;

            // Iterate through the array and sum up the 'opening' and 'closing' values
            foreach ($tank_data_array as $item) {
                // Ensure 'opening' and 'closing' are treated as numbers
                $opening = isset($item['opening']) ? (float) $item['opening'] : 0;
                $closing = isset($item['closing']) ? (float) $item['closing'] : 0;

                // Accumulate sums
                $sum_of_opening += $opening;
                $sum_of_closing += $closing;
            }

            $sum_of_nozel_sales = 0;

            // Iterate through the array and sum up the 'opening' and 'closing' values
            foreach ($nozzles_data_array as $item) {
                // Ensure 'opening' and 'closing' are treated as numbers
                $sales = $item['closing'] - $item['opening'];

                // Accumulate sums
                $sum_of_nozel_sales += $sales;
            }


            $variance = $sum_of_closing - $sum_of_total_book_value;
            $variance_of_sales = ($sum_of_closing != 0) ? ($variance / $sum_of_closing) * 100 : 0;

            $dateFrom = new DateTime($first_row['created_at']);
            $dateTo = new DateTime($last_row['created_at']);

            // Calculate the difference between the two dates
            $interval = $dateFrom->diff($dateTo);

            // Get the difference in days
            $daysDifference = $interval->days;
            $average_daily_sales = ($daysDifference != 0) ? ($sum_of_closing / $daysDifference) : 0;

            $dealerProductCounts = [
                "product_id" => $product_id,
                "total_days" => $daysDifference,
                "tanks" => json_encode($tank_data_array),
                "sum_of_opening" => $sum_of_opening,
                "sum_of_closing" => $sum_of_closing,
                "nozzel" => json_encode($nozzles_data_array),
                "total_sales" => $sum_of_nozel_sales,
                "total_recipt" => $sum_of_total_recipt,
                "book_value" => $sum_of_total_book_value,
                "variance" => $variance,
                "remark" => '',
                "shortage_claim" => '',
                "variance_of_sales" => $variance_of_sales,
                "average_daily_sales" => $average_daily_sales,
                "created_at" => '',
                "created_by" => '',
                "product_name" => $product_name,
                "dealer_name" => '',
                "from" => $first_row['created_at'],
                "to" => $last_row['created_at'],
            ];

            $data[] = $dealerProductCounts;
        }

        // Encode the final data array to a JSON string
        $jsonResult = json_encode($data);

        // Output the JSON string
        echo $jsonResult;

    } else {
        echo 'Wrong Key...';
    }
} else {
    echo 'Key is Required';
}
?>