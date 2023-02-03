<?php
session_start();

// go to index.php if user is not logged in as mcr
if ($_SESSION['role'] != 'municipal') {
    header("Location: index.php");
    exit();
}

// include the server connection file
//require 'chat_hub.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MCR Chat</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel="stylesheet" href="Styles/mcr_chat.css">
    <link rel="stylesheet" type="text/css" href="Styles/index.css">
</head>

<body>

    <?php include 'header.php'; ?>
    <div class="container" id="mcr_chat">
        <div class="row">
            <section class="chats">
                <div class="chat search">
                    <div class="searchbar">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" id="chat_search" onkeyup="filterChats()" placeholder="Search..."></input>
                    </div>
                </div>
                <div v-for="chat in filteredChats" class="chat" v-on:click="selectChat(chat)">
                    <div class="desc-contact">
                        <p class="name">{{ chat.receiver.name }}
                            <span class="badge badge-info">
                                {{chat.receiver.role}} </span>
                        </p>
                        <p class="message">{{ chat.messages[-1] }}</p>
                    </div>
                    <div class="timer ml-auto mr-3">12 sec</div>
                </div>
            </section>

            <section class="chat">
                <div class="header-chat">
                    <i class="icon fa fa-user-o" aria-hidden="true"></i>
                    <span v-if="Object.hasOwn(selectedChat ,'receiver')">
                        <p class="name">{{ selectedChat.receiver.name }}</p>
                    </span>
                    <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
                </div>
                <div class="messages-chat" id="chat-box">
                    <div v-for="(msg,index) in selectedChat.messages">
                        <!--SENDER-->
                        <div v-if="msg.sender_id === mcr.id">
                            <div class="message">
                                <div class="response">
                                    <p class="text"> {{msg.body}} </p>
                                </div>
                            </div>
                            <p v-if="index === selectedChat.length - 1" class="response-time time"> {{ msg.timestamp }}</p>
                        </div>
                        <!--RECEIVER-->
                        <div v-else>
                            <div class="message">
                                <p class="text"> {{msg.body}} </p>
                            </div>
                            <p v-if="index === selectedChat.length - 1" class="time"> {{ msg.timestamp }}</p>
                        </div>
                    </div>
                </div>
                <div class="footer-chat">
                    <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
                    <input type="text" class="write-message" v-model="selectedChat.message" v-on:keyup.enter="sendMessage()" placeholder="Type your message here">
                    <i v-on:click="sendMessage()" class="icon send fa fa-paper-plane-o clickable" aria-hidden="true"></i>
                </div>
            </section>
        </div>
    </div>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="./Scripts/JavaScript/mcr_chat.js"></script>
</body>

</html>