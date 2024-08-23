<?php

// Fetch data from the API
$api_url = "http://151.106.17.246:8080/bycobridgeApis/get/get_dealers_recons.php?key=03201232927&dealer_id=54&from=2024-06-30&to=2024-08-08";
$json_data = file_get_contents($api_url);

if ($json_data === false) {
    die('Error fetching data from API.');
}

// Decode JSON data into PHP associative array
$data = json_decode($json_data, true);

if ($data === null) {
    die('Error decoding JSON data.');
}

// Initialize an array to hold the formatted data
$formatted_data = [];

foreach ($data as $dealer) {
    // Extract common dealer information
    $site = $dealer['name'] ?? '';
    $territory = $dealer['terr'] ?? '';
    $region = $dealer['region'] ?? '';
    $tm_name = $dealer['name'] ?? '';

    // Reset product-specific variables for each dealer
    $diesel_opening_stock = 0;
    $diesel_receipts = 0;
    $diesel_sales = 0;
    $diesel_book_stock = 0;
    $diesel_variance = 0;
    $diesel_variance_percentage = 0;
    $gasoline_opening_stock = 0;
    $gasoline_receipts = 0;
    $gasoline_sales = 0;
    $gasoline_book_stock = 0;
    $gasoline_variance = 0;
    $gasoline_variance_percentage = 0;
    $daily_sales = 0;
    $no_os_days = 0;
    $opening_date = '';
    $closing_date = '';

    // Loop through each product's reconciliation data
    foreach ($dealer['recon'] as $recon) {
        $opening_date = $recon['last_recon_date'] ?? '';  // Starting date from the request
        $closing_date = $recon['created_at'] ?? '';    // Ending date from the request
        $no_os_days = $recon['total_days'] ?? 0; // Calculate the number of days

        // Daily sales might be product-specific, adjust if necessary
        $daily_sales += $recon['total_sales'] ?? 0;

        // Diesel Data
        if ($recon['product_name'] == 'HSD') {
            $diesel_opening_stock = $recon['sum_of_opening'] ?? 0;
            $diesel_receipts = $recon['total_recipt'] ?? 0;
            $diesel_sales = $recon['total_sales'] ?? 0;
            $diesel_book_stock = $recon['book_value'] ?? 0;
            $diesel_variance = $recon['variance'] ?? 0;
            $diesel_variance_percentage = $recon['variance_of_sales'] ?? 0;
        }

        // Gasoline Data
        if ($recon['product_name'] == 'PMG') {
            $gasoline_opening_stock = $recon['sum_of_opening'] ?? 0;
            $gasoline_receipts = $recon['total_recipt'] ?? 0;
            $gasoline_sales = $recon['total_sales'] ?? 0;
            $gasoline_book_stock = $recon['book_value'] ?? 0;
            $gasoline_variance = $recon['variance'] ?? 0;
            $gasoline_variance_percentage = $recon['variance_of_sales'] ?? 0;
        }
    }

    // Add formatted row to the data array
    $formatted_data[] = [
        'site' => $site,
        'tm' => $tm_name,
        'territory' => $territory,
        'region' => $region,
        'opening_date' => date('j-M-y', strtotime($opening_date)),
        'closing_date' => date('j-M-y', strtotime($closing_date)),
        'no_os_days' => $no_os_days,
        'daily_sales' => $daily_sales,
        'diesel_opening_stock' => $diesel_opening_stock,
        'diesel_receipts' => $diesel_receipts,
        'diesel_sales' => $diesel_sales,
        'diesel_book_stock' => $diesel_book_stock,
        'diesel_variance' => $diesel_variance,
        'diesel_variance_percentage' => number_format($diesel_variance_percentage, 2),
        'gasoline_opening_stock' => $gasoline_opening_stock,
        'gasoline_receipts' => $gasoline_receipts,
        'gasoline_sales' => $gasoline_sales,
        'gasoline_book_stock' => $gasoline_book_stock,
        'gasoline_variance' => $gasoline_variance,
        'gasoline_variance_percentage' => number_format($gasoline_variance_percentage, 2),
        'comments' => '',  // Assuming comments are fetched separately or added manually
        'hsd' => '',  // Assuming HSD data is fetched separately or calculated
        'pmg' => '',  // Assuming PMG data is fetched separately or calculated
    ];
}

// Convert the formatted data to JSON
$jsonData = json_encode($formatted_data);

// Output the JSON string
echo $jsonData;
?>
