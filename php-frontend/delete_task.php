<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['token'])) {
    header('Location: index.php');
    exit();
}

$token = $_SESSION['token'];

// Get the task ID from the query string
$id = $_GET['id'];

// API endpoint URL
$api_url = 'http://localhost:3000/tasks/' . $id;

// Set up cURL
$ch = curl_init($api_url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token
));

// Execute the API call
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
    exit();
}

// Close cURL
curl_close($ch);

// Redirect back to the tasks page
header('Location: tasks.php');
exit();
?>
