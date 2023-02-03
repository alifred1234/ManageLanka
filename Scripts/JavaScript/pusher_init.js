export default function pusherInit(interests) {
    const beamsClient = new PusherPushNotifications.Client({
        instanceId: "8b7aac60-9aa9-4fe3-92da-fb40bc245dca",
    });
    beamsClient
        .start()
        .then((beamsClient) => beamsClient.getDeviceId())
        .then((deviceId) =>
            console.log("Successfully registered with Beams. Device ID:", deviceId)
        )
        .then(()=>{

                interests.forEach((interest) => {
                    beamsClient.addDeviceInterest(interest);
                })
            }
        )
}