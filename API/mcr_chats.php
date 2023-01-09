<?php
require '../Scripts/Php/db.php';
include_once('../Models/User.php');

$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];

// post methods
if($REQUEST_METHOD == 'POST'){

// send message post method
   if(isset($_POST['send_message'])) {
       $sender_id = $_POST['sender_id'];
       $receiver_id = $_POST['receiver_id'];
       $message = $_POST['message'];
       //TODO: protect against sql injection
      $sql = "INSERT INTO chat_messages (sender_id, receiver_id, body, timestamp) 
                VALUES ('$sender_id', '$receiver_id', '$message', now())";
      $result = $conn->query($sql);
        if($result){
             echo json_encode(array('success' => 'Message sent successfully'));}
}
}

// get methods
if($REQUEST_METHOD == 'GET' && isset($_GET['business_id'])) {
    $id = $_GET['business_id'];
    // get chats of the business by id

    // query all messages of business in ascending order of timestamp
    $sql = "SELECT * FROM chat_messages WHERE (sender_id = '$id' OR receiver_id = '$id') ORDER BY timestamp ASC";
    $result = $conn->query($sql);

    // group chats by other user
    $chats = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $other_user_id = $row['sender_id'] == $id ? $row['receiver_id'] : $row['sender_id'];
            if (!isset($chats[$other_user_id])) {
                $user = getUser($other_user_id, $conn);
                $chats[$other_user_id]["receiver"] = $user;
                $chats[$other_user_id]["messages"] = array();
                //TODO: unread message count
            }
            array_push($chats[$other_user_id]["messages"], $row);
        }
        echo json_encode($chats);
    }

}

