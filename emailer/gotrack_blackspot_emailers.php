<?php

// Define constants for database connection
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Ptoptrack@(!!@');
define('DB_DATABASE', 'bycobridge');
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Set PHP configurations
ini_set('memory_limit', '-1');
set_time_limit(500);
error_reporting(0);

// Include necessary files
include('class/class.phpmailer.php');
include('pdf.php');

// Capture request parameters
$vehicle = $_GET['vehicle'] ?? '';
$spot_name = $_GET['spot_name'] ?? '';
$in_time = $_GET['in_time'] ?? '';

// Ensure all required parameters are provided
if (!empty($vehicle) && !empty($spot_name) && !empty($in_time)) {

    // List of CC email recipients
    $cc_emails = [
        'usmanhameed@gmail.com',
        'abasit9119@gmail.com'
    ];

    // Send the email
    smtp_mailer('naveed.captiva@gmail.com', date('Y-m-d H:i:s'), $vehicle, $spot_name, $in_time, $cc_emails);
} else {
    echo "Required parameters missing.";
}

/**
 * Function to send Black Spot Alert emails
 */
function smtp_mailer($to, $time, $vehicle, $spot_name, $in_time, $cc_emails)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);

    // Use environment variables for email credentials (for security)
    $mail->Username = "byco.alertinfo@gmail.com";
    $mail->Password = "cocrqreeqfbovzvi";
    $mail->SetFrom("byco.alertinfo@gmail.com");
    $mail->AddAddress($to);

    // Add CC emails
    foreach ($cc_emails as $cc_email) {
        $mail->addCC($cc_email);
    }

    // Email content
    $mail->Subject = 'Black Spot Alert for vehicle ' . htmlspecialchars($vehicle);
    $mail->Body = '<h3>Dear Team,<br>' .
        htmlspecialchars($vehicle) . ' entered Black Spot ' .
        htmlspecialchars($spot_name) . ' at ' .
        htmlspecialchars($in_time) . '</h3><br>';

    // Send the email and check for errors
    if ($mail->Send()) {
        echo "Email sent successfully.";
    } else {
        echo "Email sending failed: " . $mail->ErrorInfo;
    }
}

/**
 * Helper function to format amounts
 */
function format_amount($amount)
{
    return is_numeric($amount) ? number_format($amount, 2) : $amount;
}

?>