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

<header id="header">
    <!-- NAV BAR -->
    <nav class="nav">
        <!-- LOGO -->
        <div class="logo">
            <a id="logo-text" href="index.php">ManageLanka</a>
        </div>

        <?php
            // if session is open, it will show a logout option
            // options for citizens
            if (isset($_SESSION['username']) && $_SESSION['role'] == "citizen") {
                echo ('
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="schedules.php" class="nav-link">Schedules</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Promotions</a>
                            </li>
                            <li class="nav-item">
                                <a href="events.php" class="nav-link">Events</a>
                            </li>
                        </ul>
                    ');
                echo '<section class="para"><p>You are logged in</p></section>';
                echo '<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />';
                echo '
                    <form action="Scripts/Php/logout.php" method="POST">
                        <button type="submit" name="logout" class="btn-grouped">Logout</button>
                    </form>
                    ';

                // options for mcr
            } else if (isset($_SESSION['username']) && $_SESSION['role'] == "municipal") {
                echo ('
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="schedules.php" class="nav-link">Schedules</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Advertisements</a>
                            </li>
                        </ul>
                    ');
                echo '<section class="para"><p>You are logged in</p></section>';
                echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
                echo '
                    <form action="Scripts/Php/logout.php" method="POST">
                        <button type="submit" name="logout" class="btn-grouped">Logout</button>
                    </form>
                    ';

                // options for restaurant and retailer
            } else if (isset($_SESSION['username']) && ($_SESSION['role'] == "restaurant" || $_SESSION['role'] == "retailer")) {
                echo ('
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Promotions</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Donations</a>
                            </li>
                        </ul>'
                );
                echo '<section class="para"><p>You are logged in</p></section>';
                echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
                echo '
                    <form action="Scripts/Php/logout.php" method="POST">
                        <button type="submit" name="logout" class="btn-grouped">Logout</button>
                    </form>
                    ';

                // options for recycle company
            } else if (isset($_SESSION['username']) && $_SESSION['role'] == "recycler") {
                echo ('
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Advertisements</a>
                            </li>
                        </ul>
                    ');
                echo '<section class="para"><p>You are logged in</p></section>';
                echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
                echo '
                    <form action="Scripts/Php/logout.php" method="POST">
                        <button type="submit" name="logout" class="btn-grouped">Logout</button>
                    </form>
                    ';

                // options for volunteer group manager
            } else if (isset($_SESSION['username']) && $_SESSION['role'] == "volunteer") {
                echo ('
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Advertisements</a>
                            </li>
                            <li class="nav-item">
                                <a href="events.php" class="nav-link">Events</a>
                            </li>
                        </ul>
                    ');
                echo '<section class="para"><p>You are logged in</p></section>';
                echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
                echo '
                        <form action="Scripts/Php/logout.php" method="POST">
                            <button type="submit" name="logout" class="btn-grouped">Logout</button>
                        </form>
                    ';

                // options for admin
            } else if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
                echo ('
                        <ul class="nav-list">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Manage Users</a>
                            </li>
                        </ul>
                    ');
                echo '<section class="para"><p>You are logged in</p></section>';
                echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
                echo '
                        <form action="Scripts/Php/logout.php" method="POST">
                            <button type="submit" name="logout" class="btn-grouped">Logout</button>
                        </form>
                    ';

            } else {
                // if session is closed, it will show a signin and login option
                echo '
                        <section class="para"><p>You are logged out</p></section>
                            <button><a href="login.php" class="btn-grouped">Login</a></button>
                            <button><a href="register.php" class="btn-grouped">Sign Up</a></button>';
            }

            ?>

    </nav>
</header>

<body>

    <div class="banner">
        <div class="app-text">
            <h1>ECOLOGY</h1>
            <h3>GO GREEN</h3>
            <p>ManageLanka is a website that optimizes Garbage Management and Excess Food Management. ManageLanka has
                different section-specific users. Citizens, municipal council representatives, and recycling
                companies use Garbage management section. Citizens, volunteer group managers, restaurants, and retailers
                use Excess food management section. The
                platform hopes to improves user efficiency.
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
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </li>
            <li>
                <img src="images/home3.png">
                <h1>Excess Food Management</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </li>
        </ul>
    </div>
</body>

</html>