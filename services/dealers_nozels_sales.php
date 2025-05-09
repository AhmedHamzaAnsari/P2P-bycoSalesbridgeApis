<?php
ini_set('max_execution_time', '0');
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 100; URL=$url1");

include("../config.php");

$access_key = '03201232927';
$pass = $_GET["key"] ?? '';

if ($pass === '') {
    exit("❗ Key is Required");
}

if ($pass !== $access_key) {
    exit("❌ Wrong Key...");
}

// Call API
$api_url = "http://217.65.144.94:8069/bpos/bpos/data";
$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'API Error: ' . curl_error($ch);
    curl_close($ch);
    exit;
}
curl_close($ch);

// Clean JSON response
$response = str_replace("False", "null", $response);
$response = preg_replace("/'/", "\"", $response);
$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    exit("JSON Decode Error: " . json_last_error_msg());
}

if (!is_array($data)) {
    exit("❌ Invalid API Response.<br>");
}

// Process API Data
foreach ($data as $item) {
    $id = mysqli_real_escape_string($db, $item['id']);
    $name = $item['name'] ?? null;
    $amount = floatval($item['amount']);
    $litre = floatval($item['litre']);
    $rate = floatval($item['rate']);
    $total_mtr = floatval($item['total_mtr']);
    $dealer_id = 80327;
    $datetime = date('Y-m-d H:i:s');

    // Check for duplicate
    $check_query = "SELECT COUNT(*) as count FROM `dealers_nozzels_sales` WHERE SlipNumber = '$id'";
    $check_result = mysqli_query($db, $check_query);

    if (!$check_result) {
        echo "❌ Query Error: " . mysqli_error($db) . "<br>";
        continue;
    }

    $check_row = mysqli_fetch_assoc($check_result);
    if ($check_row['count'] > 0) {
        echo "ℹ️ Already exists: $id<br>";
        continue;
    }

    // Insert new record
    $insert = "INSERT INTO `dealers_nozzels_sales`
        (`dealers_sap`, `SlipNumber`, `slipDateTime`, `ShiftNumber`, `NozzleNo`, `ProductCode`,
         `Quantity`, `Rate`, `Amount`,`totalizer`, `UserID`, `CopiesPrinted`, `SMS`, `CashOrCredit`,
         `TankNo`, `created_at`)
        VALUES
        ('$dealer_id', '$id', '$datetime', '1', '1', '1',
         '$litre', '$rate', '$amount', '$total_mtr', '1', '1', '1', 'Cash', '1', '$datetime')";

    if (mysqli_query($db, $insert)) {
        echo "✅ Inserted: $id<br>";
    } else {
        echo "❌ Error inserting $id: " . mysqli_error($db) . "<br>";
    }
}

echo "<br>🕒 Last Run: " . date('Y-m-d H:i:s');
?>
