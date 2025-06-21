<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
<form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>

    <?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // API endpoint URL
        $api_url = 'http://localhost:3000/login';

        // Set up cURL
        $ch = curl_init($api_url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('username' => $username, 'password' => $password)));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

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
        $result = json_decode($response, true);

        // Check if the response is valid and contains a token
        if (isset($result['token'])) {
            // Store the token in the session
            $_SESSION['token'] = $result['token'];

            // Redirect to the tasks page
            header('Location: tasks.php');
            exit();
        } else {
            echo 'Invalid credentials.';
        }
    }
    ?>
</body>
</html>
