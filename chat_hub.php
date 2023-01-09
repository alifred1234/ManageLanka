<?php
require 'Scripts/Php/db.php';
// Include the Ratchet library
require 'vendor/autoload.php';

use Ratchet\App;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;

//// Create a chat server class that implements the MessageComponentInterface
class ChatServer implements MessageComponentInterface
{
    protected $clients;
    private $subscriptions;
    private $users;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        global $conn;

        $data = json_decode($msg);
        switch ($data->command) {
            case "subscribe":
                echo "subscribing to " . $data->channel ;
                $this-> users[$data -> channel] = $from;
                break;
            case "message":
                $message = $data -> message;
                echo json_encode($message);
                $sender_id = $message -> sender_id;
                $receiver_id = $message -> receiver_id;
                $body = $message -> body;

                //add timestamp to message
                $timestamp = date('Y-m-d H:i:s');
                $data -> message -> timestamp = $timestamp;

                //store message in database
                $sql = "INSERT INTO chat_messages (sender_id, receiver_id, body, timestamp) 
                VALUES ('$sender_id', '$receiver_id', ?, '$timestamp')";
                $stmt = mysqli_stmt_init($conn); //check connection
                if (mysqli_stmt_prepare($stmt, $sql)) { //protect against sql injection by user typing queries
                    mysqli_stmt_bind_param($stmt, "s", $body); //binding username parameter to statement
                    mysqli_stmt_execute($stmt);

                    //send message to self
                    $response = json_encode($data);
                    $from->send($response);

                    //send message to client
                    $to = $this->users[$receiver_id];
                    if($to != null) {
                        $to->send($response);
                    }
                }
                break;
        }
    }

    public function onClose(ConnectionInterface $connection)
    {
        $this->clients->detach($connection);
        // The connection is closed, remove it, as we can no longer send it messages
        // find user key from users array by connection
        $user = array_search($connection, $this->users);
        // remove user from users array
        unset($this->users[$user]);
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $connection->close();
    }
}


$server = new App('localhost', 8080, '0.0.0.0');

$server->route('/chat', new ChatServer(), ['*']);

$server->run();