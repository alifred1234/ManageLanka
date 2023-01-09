<?php

class User
{
    private $id;
    private $name;
    private $username;
    private $role;
    private $usertype;

    public function __construct($id, $name, $username, $role, $usertype)
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->role = $role;
        $this->usertype = $usertype;
    }
}

// Get the logged-in user from the database
function getLoggedInUser($conn) {
    // Get the user id from the session
    $user_id = $_SESSION['id'];

    // Get the user from the database
    // Return the user
    return getUser($user_id, $conn);
}

function getUser($user_id, $conn)
{
    // Get the user from the database
    $sql = "SELECT id, name, username, role, usertype FROM registration WHERE id = '{$user_id}'";
//    echo json_encode($sql);
    $result = $conn->query($sql);
    // Check if the user exists
    if ($result->num_rows > 0) {
        // Return the user
        return $result->fetch_assoc();
    } else {
        // Return null if the user does not exist
        return null;
    }
}