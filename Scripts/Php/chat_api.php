<?php
require 'db.php';
// Connect to the database
$conn = mysqli_connect('hostname', 'username', 'password', 'database_name');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check the request method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle a GET request
    // Get the message ID from the request
    $message_id = $_GET['id'];

    // Select the message from the database
    $sql = "SELECT * FROM chat_messages WHERE id = '$message_id'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (mysqli_num_rows($result) > 0) {
        // Fetch the result as an associative array
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $sender = $row['sender'];
        $recipient = $row['recipient'];
        $content = $row['content'];

        // Create a new ChatMessage object
        $message = new ChatMessage($id, $sender, $recipient, $content);

        // Return the message as a JSON object
        header('Content-Type: application/json');
        echo json_encode(array(
            'id' => $message->getId(),
            'sender' => $message->getSender(),
            'recipient' => $message->getRecipient(),
            'content' => $message->getContent()
        ));
    } else {
        // Return an error if no matching records were found
        header('Content-Type: application/json');
        header('HTTP/1.1 404 Not Found');
        echo json_encode(array(
            'error' => 'Message not found'
        ));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle a POST request
    // Get the message data from the request body
    $data = json_decode(file_get_contents('php://input'), true);
    $sender = $data['sender'];
    $recipient = $data['recipient'];
    $content = $data['content'];

    // Insert the message into the database
    $sql = "INSERT INTO chat_messages (sender, recipient, content) VALUES ('$sender', '$recipient', '$content')";
}

