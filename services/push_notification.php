<?php
// Database credentials
include ("../config.php");

// Create a connection to the database

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// FCM Server Key (replace with your actual FCM server key)
define('FCM_SERVER_KEY', 'BB-GkMMcK24nCDTaUDQg4bG42j5swSmv064NH831CJtpVd8ksDyFmSCT3C83_g9sLn9xYyhQgG0VWpLG1314vLE');

// Function to send notification
function sendNotification($title, $message, $token) {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array (
        'to' => $token,
        'notification' => array (
            'title' => $title,
            'body' => $message
        )
    );

    $headers = array(
        'Authorization: key=' . FCM_SERVER_KEY,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

// Endpoint to receive new notifications
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $message = $_POST['message'];

    // Fetch FCM tokens from the database
    $sql = "SELECT fcm_token FROM users";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $token = $row['fcm_token'];
            $response = sendNotification($title, $message, $token);
            echo "Notification sent to $token: $response<br>";
        }
    } else {
        echo "No FCM tokens found.";
    }
} else {
    echo "Invalid request method.";
}

$db->close();
?>
