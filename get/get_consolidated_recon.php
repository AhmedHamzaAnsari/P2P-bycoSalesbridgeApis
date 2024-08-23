<?php
// fetch.php  
include("../config.php");

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
                FROM bycobridge.dealers_products as pd 
                JOIN all_products as pp ON pp.id = pd.name
                WHERE pd.dealer_id = $dealer_id;";
        $result = $db->query($sql);

        while ($row = $result->fetch_assoc()) {
            $product_id = $row["name"];
            $product_name = $row["product_name"];
            $tank_data_array = [];
            $nozzels_data_array = [];

            $get_orders = "SELECT rr.*, pp.name as product_name, dc.name as dealer_name 
                           FROM bycobridge.dealer_stock_recon_new as rr
                           JOIN bycobridge.all_products as pp ON pp.id = rr.product_id
                           JOIN bycobridge.dealers as dc ON dc.id = rr.dealer_id 
                           WHERE rr.dealer_id = $dealer_id AND DATE(rr.created_at) >= '$from' 
                           AND DATE(rr.created_at) <= '$to' AND rr.product_id = $product_id";

            $result_orders = $db->query($get_orders);
            $sum_of_opening = 0;
            $sum_of_closing = 0;
            $sum_of_nozel_sales = 0;
            $sum_of_total_recipt = 0;
            $sum_of_total_book_value = 0;

            while ($row_2 = $result_orders->fetch_assoc()) {
                $tanks_data = $row_2['tanks'];
                $dataArray = json_decode($tanks_data, true);

                $total_recipt = is_numeric($row_2['total_recipt']) ? $row_2['total_recipt'] : 0;
                $book_value = is_numeric($row_2['book_value']) ? $row_2['book_value'] : 0;

                $sum_of_total_recipt += $total_recipt;
                $sum_of_total_book_value += $book_value;

                if (isset($dataArray['id'])) {
                    $dataArray = [$dataArray];
                }

                foreach ($dataArray as $item) {
                    $opening = is_numeric($item['opening']) ? $item['opening'] : 0;
                    $closing = is_numeric($item['closing']) ? $item['closing'] : 0;
                    $tank_id = $item['id'];
                    $tank_name = $item['name'];
                    $opening_dip = is_numeric($item['opening_dip']) ? $item['opening_dip'] : 0;
                    $closing_dip = is_numeric($item['closing_dip']) ? $item['closing_dip'] : 0;

                    $sum_of_opening += $opening;
                    $sum_of_closing += $closing;

                    if (isset($tank_data_array[$tank_id])) {
                        $tank_data_array[$tank_id]['opening'] += $opening;
                        $tank_data_array[$tank_id]['closing'] += $closing;
                        $tank_data_array[$tank_id]['opening_dip'] += $opening_dip;
                        $tank_data_array[$tank_id]['closing_dip'] += $closing_dip;
                    } else {
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

                $nozzel_data = $row_2['nozzel'];
                $nozzel_data_Array = json_decode($nozzel_data, true);

                foreach ($nozzel_data_Array as $item) {
                    $opening = is_numeric($item['opening']) ? $item['opening'] : 0;
                    $closing = is_numeric($item['closing']) ? $item['closing'] : 0;
                    $nozel_id = $item['id'];
                    $nozel_name = $item['name'];

                    $nozel_sales = $closing - $opening;

                    $sum_of_nozel_sales += $nozel_sales;

                    if (isset($nozzels_data_array[$nozel_id])) {
                        $nozzels_data_array[$nozel_id]['opening'] += $opening;
                        $nozzels_data_array[$nozel_id]['closing'] += $closing;
                    } else {
                        $nozzels_data_array[$nozel_id] = array(
                            'id' => $nozel_id,
                            'name' => $nozel_name,
                            'opening' => $opening,
                            'closing' => $closing
                        );
                    }
                }

                $is_totalizer_data = $row_2['is_totalizer_data'];
                if ($is_totalizer_data != "") {
                    foreach ($nozzel_data_Array as $item) {
                        $opening = is_numeric($item['opening']) ? $item['opening'] : 0;
                        $closing = is_numeric($item['closing']) ? $item['closing'] : 0;
                        $nozel_id = $item['id'];
                        $nozel_name = $item['name'];

                        $nozel_sales = $closing - $opening;

                        $sum_of_nozel_sales += $nozel_sales;

                        if (isset($nozzels_data_array[$nozel_id])) {
                            $nozzels_data_array[$nozel_id]['opening'] += $opening;
                            $nozzels_data_array[$nozel_id]['closing'] += $closing;
                        } else {
                            $nozzels_data_array[$nozel_id] = array(
                                'id' => $nozel_id,
                                'name' => $nozel_name,
                                'opening' => $opening,
                                'closing' => $closing
                            );
                        }
                    }
                }
            }

            // Re-index the arrays to remove IDs as keys
            $tank_data_array = array_values($tank_data_array);
            $nozzels_data_array = array_values($nozzels_data_array);

            $variance = $sum_of_closing - $sum_of_total_book_value;
            $variance_of_sales = ($sum_of_closing != 0) ? ($variance / $sum_of_closing) * 100 : 0;

            $dateFrom = new DateTime($from);
            $dateTo = new DateTime($to);

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
                "nozzel" => json_encode($nozzels_data_array),
                "total_sales" => $sum_of_nozel_sales,
                "total_recipt" => $sum_of_total_recipt,
                "book_value" => $sum_of_total_book_value,
                "variance" => $variance,
                "remark" => '',
                "shortage_claim" => '',
                "variance_of_sales" => $variance_of_sales,
                "average_daily_sales" => $average_daily_sales,
                "created_at" => 'created_at',
                "created_by" => 'created_by',
                "product_name" => $product_name,
                "dealer_name" => 'dealer_name',
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
