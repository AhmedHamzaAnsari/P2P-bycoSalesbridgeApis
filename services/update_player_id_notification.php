<?php
include ("../config.php");

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get POST data
$externalId = $_POST['external_id'];
$playerId = $_POST['player_id'];

// Update player_id for the given external_id
$sql = "UPDATE users SET playerId = '$playerId' WHERE id = '$externalId'";
if (mysqli_query($db, $sql)) {
    echo  'Player ID Updated' ;

} else {
    $output = '"Error updating Player ID' . mysqli_error($db) . '<br>' . $sql;

}

echo  $output;


$db->close();
?>
