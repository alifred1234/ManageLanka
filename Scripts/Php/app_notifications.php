<?php
include  'pusher.php';
//a class to handle promotion notifications
class AppNotifications
{
    private static $instance;
    private BeamsNotification $beamsNotification;

    private function __construct()
    {
        $this->beamsNotification = BeamsNotification::getInstance();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function sendPromotionNotification()
    {
        //title of the notification
        $title = "New Promotion";
        //body of the notification
        $body = "A new promotion has been added to the app";
        //deep link to the promotion
        $deep_link = "http://localhost/promotions.php";
        //interests to send the notification to
        $interests = array("promotion");

        //send the notification
        $this->beamsNotification->sendNotification($title, $body, $deep_link, $interests);
    }

    public function sendAdvertNotificaiton()
    {
        //title of the notification
        $title = "New Advert";
        //body of the notification
        $body = "A new advert has been added to the app";
        //deep link to the advert
        $deep_link = "http://localhost/adverts.php";
        //interests to send the notification to
        $interests = array("advert");

        //send the notification
        $this->beamsNotification->sendNotification($title, $body, $deep_link, $interests);
    }

}
