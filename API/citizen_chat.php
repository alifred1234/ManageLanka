<?php
require '../Scripts/Php/db.php';

$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];

// get methods
if($REQUEST_METHOD == 'GET' && isset($_GET['citizen_id'])) {
    $id = $_GET['citizen_id'];
    // get chats of the business by id

    // query all messages of business
    $sql = "SELECT * FROM chat_messages WHERE (sender_id = '$id' OR receiver_id = '$id') ORDER BY timestamp ASC";
    $result = $conn->query($sql);

    // append messages from result to array
    $messages = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($messages, $row);
        }
    }
    $response['messages'] = $messages;


    // get mcr relevant to the district in which the citizen lives
    $sql = "SELECT id FROM registration WHERE (district = (SELECT district FROM registration WHERE id = '$id') 
                              AND role = 'municipal')";
    $result = $conn->query($sql);
    $mcr_id = $result->fetch_assoc()['id'];
    $response['mcr_id'] = $mcr_id;

    echo json_encode($response);

}

