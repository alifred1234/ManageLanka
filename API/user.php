<?php
session_start();
require '../Scripts/PHP/db.php';
require '../Models/User.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get the logged-in user
    $user = getLoggedInUser($conn);
    // Check if the user exists
    header('Content-Type: application/json; charset=utf-8');
    if ($user != null) {
        // Return the user
        echo json_encode($user);
    } else {
        // Return an error
        echo json_encode(array('error' => 'User does not exist'));
    }
}
