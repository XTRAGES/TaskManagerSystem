<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['token'])) {
    header('Location: index.php');
    exit();
}

$token = $_SESSION['token'];

// API endpoint URL
$api_url = 'http://localhost:3000/tasks';

// Set up cURL
$ch = curl_init($api_url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
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

// Decode the JSON response
$tasks = json_decode($response, true);

// Check if the response is valid
if (!is_array($tasks)) {
    echo 'Invalid API response: ' . $response;
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
</head>
<body>
    <h1>Tasks</h1>
    <ul>
        <?php if (is_array($tasks)): ?>
            <?php foreach ($tasks as $index => $task): ?>
                <li><?php echo htmlspecialchars($task['title']); ?> <a href="delete_task.php?id=<?php echo $index; ?>">Delete</a></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No tasks found.</li>
        <?php endif; ?>
    </ul>
<a href="logout.php">Logout</a>

    <form method="post">
        <label for="title">New Task Title:</label>
        <input type="text" id="title" name="title"><br><br>
        <button type="submit">Add Task</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newTaskTitle = $_POST['title'];

        // API endpoint URL
        $api_url = 'http://localhost:3000/tasks';

        // Set up cURL
        $ch = curl_init($api_url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('title' => $newTaskTitle)));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
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

        // Refresh the page to show the new task
        header('Location: tasks.php');
        exit();
    }
    ?>
</body>
</html>
