<?php
ini_set('max_execution_time', '0');
$url1 = $_SERVER['REQUEST_URI'];
header("Refresh: 10; URL=$url1");
include ("../config.php");

$onesignalAppId = "3749486d-6dc4-4b7e-832e-cbbb005f4458";
$onesignalRestApiKey = "Y2JmZDc0M2MtNDIwYS00NTk5LWJhNDQtMzhlYmMyZmYyN2Ix";
$logoUrl = "http://151.106.17.246:8080/bycobridgeApis/uploads/byco_logo.png"; // Replace with your logo URL

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Fetch data
$sql = "SELECT nn.*, us.playerId FROM push_notifications AS nn
        LEFT JOIN users us ON us.id = nn.user_id WHERE nn.status = 0";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  // Process your data
  while ($row = $result->fetch_assoc()) {
    // Create notification content
    $id = $row['id'];
    $playerId = $row['playerId'];
    $header = $row['header'];
    $send_by = $row['send_by'];

    // Prepare notification content
    $heading = array("en" => $header);
    $content = array("en" => $row['message']); // Use your data

    // Determine fields for sending the notification
    $fields = array(
      'app_id' => $onesignalAppId,
      'data' => array("foo" => "bar"),
      'headings' => $heading,
      'contents' => $content,
      'large_icon' => $logoUrl, // Add the logo URL for mobile
      'chrome_web_icon' => $logoUrl // Add the logo URL for web
    );

    if ($send_by === "All") {
      $fields['included_segments'] = array('All');
    } else {
      $fields['include_player_ids'] = array($playerId);
    }

    $fields = json_encode($fields);

    // Initialize CURL and send notification
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json; charset=utf-8',
      'Authorization: Basic ' . $onesignalRestApiKey
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === FALSE) {
      echo 'CURL Error: ' . curl_error($ch);
      echo "not send";
      continue;
    }

    $response_data = json_decode($response, true);

    if (isset($response_data['id'])) {
      // echo $response_data;
      echo "Send";
      // Update the status of the notification
      $query = "UPDATE `push_notifications`
                SET `status` = '1'
                WHERE `id` = '$id'";

      if ($db->query($query) === TRUE) {
        $output = 1;
      } else {
        $output = 'Error: ' . $db->error . '<br>' . $query;
      }
    } else {
      echo "Not Send";
    }
  }
} else {
  echo "0 results";
}
echo "Last Run ".date('Y-m-d H:i:s');

$db->close();
?>
