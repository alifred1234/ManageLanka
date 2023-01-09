<?php
class ChatMessage {
    // Properties to store the message ID, sender, recipient, and message content
    private $id;
    private $sender;
    private $recipient;
    private $content;

    // Constructor to initialize the message properties
    public function __construct($id, $sender, $recipient, $content) {
        $this->id = $id;
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->content = $content;
    }

    // Getter and setter methods for the message properties
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getSender() {
        return $this->sender;
    }

    public function setSender($sender) {
        $this->sender = $sender;
    }

    public function getRecipient() {
        return $this->recipient;
    }

    public function setRecipient($recipient) {
        $this->recipient = $recipient;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }
}
