<?php
    //user is logged in
    if(isset($_SESSION['username'])){
        echo ('
            <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
            <script src="Scripts/JavaScript/pusher_init.js" type="module"></script>
        ');

        if($_SESSION['role'] == 'citizen'){
            echo ('
                <script type="module">
                import pusherInit from "./Scripts/JavaScript/pusher_init.js"; 
                pusherInit(["promotion","advert"]);
                </script>
            ');
        }
        else if($_SESSION['role'] == 'recycler'){
            echo ('
                <script type="module">
                import pusherInit from "./Scripts/JavaScript/pusher_init.js"; 
                pusherInit(["advert"]);
                </script>
            ');
        }
    }

