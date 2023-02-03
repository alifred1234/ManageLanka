<?php
//vendor
require '../../vendor/autoload.php';

use Pusher\PushNotifications\PushNotifications;

class BeamsNotification
{
    private static $instance;
    private PushNotifications $beamsClient;

    private function __construct()
    {
        try {
            $this->beamsClient = new PushNotifications(array(
                "instanceId" => "8b7aac60-9aa9-4fe3-92da-fb40bc245dca",
                "secretKey" => "EBF1BA2E616A6D36AD2A9C4D4D4A03759F450111B65E064CD62AC1588CF42A5F",
            ));
        } catch (Exception $e) {
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function sendNotification($title, $body, $deep_link, $interests)
    {
        try {
            $publishResponse = $this->beamsClient->publishToInterests(
                $interests,
                array("web" => array("notification" => array(
                    "title" => $title,
                    "body" => $body,
                    "deep_link" => $deep_link,
                )),
                ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>