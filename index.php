<?php
session_start();
?>

<html lang="en">

<head>
    <title>Manage Lanka</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="Styles/index.css">
</head>

<?php
    include "header.php";
?>

<body>


    <div class="banner">
        <div class="app-text">
            <h1>About Us</h1>
            <h3>Don't WASTE food!</h3>
            <p>We here at Manage Lanka believe that management of excess food waste is a must. While almost a third of
                the world's annual food supply is lost to trash, nearly a billion people still go hungry. We want to put
                a stop to that, one step at a time.
            </p>
            <h3>Save the PLANET!</h3>
            <p>REDUCE, REUSE, AND RECYCLE is our moto here at Manage Lanka. Cut down on what you throw away. Follow the
                three "R's" to conserve natural resources and landfill space. Volunteer for cleanups in your community.
                You can get involved in protecting your watershed, too.
            </p>

            <?php

            // if session is open, it will show a logout option
            if (!isset($_SESSION['username'])) {
                echo ('
                            <div>
                                <a href="register.php" class="btn-grouped special">Register with us!</a>
                            </div>
                        ');
            }

            ?>

        </div>
        <div class="app-picture">
            <img src="Images/home1.png">
        </div>
    </div>

    <div class="about-services">
        <ul>
            <li>
                <img src="Images/home2.png">
                <h1>Garbage management</h1>
                <p>We offer a few features that may assist in Garbage management.
                    Firstly, we have district based schedules that are updated by the council themselves. We also aid in
                    the process of connecting recycling companies and the Municipal council through advertisements set
                    to decrease that chance of recyclable waste reaching the landfills.
                </p>
            </li>
            <li>
                <img src="images/home3.png">
                <h1>Excess Food Management</h1>
                <p>Using this site, become a volunteer just by joining fellow volunteering groups with their donation
                    campaigns and foodruns. We also try to minimise food waste from local restaurants and retailers by
                    allowing them to post promotions to clear goods nearing their shelf-life or food that were just a
                    bit too much for that!</p>
            </li>
        </ul>
    </div>
    <?php
        
        if (isset($_SESSION['username'])){
            if($_SESSION['role'] == 'citizen' || $_SESSION['role'] == 'recycler'){
                include 'citizen_chat.php';
            }
        }
        
?>
</body>

</html>