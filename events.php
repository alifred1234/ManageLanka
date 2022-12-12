<?php

session_start();

require 'Scripts/Php/db.php';

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "Images/" . $filename;

    // Get all the submitted data from the form
    $sql = "INSERT INTO events (filename) VALUES ('$filename')";

    // Execute query
    mysqli_query($conn, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }
}
?>

<html>

<head>
    <title>Image Upload</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="Styles/events.css" />
    <link rel="stylesheet" href="Styles/index.css">
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
            </ul>');
            echo '<section class="para"><p>You are logged in</p></section>';
            echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
            echo '<form action="Scripts/Php/logout.php" method="POST">
            <button type="submit" name="logout" class="btn-grouped">Logout</button>
            </form>';
        } else if (isset($_SESSION['username']) && $_SESSION['role'] == "municipal") {
            echo ('
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="schedules.php" class="nav-link">Schedules</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Advertisements</a>
                </li>
            </ul>');
            echo '<section class="para"><p>You are logged in</p></section>';
            echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
            echo '<form action="Scripts/Php/logout.php" method="POST">
            <button type="submit" name="logout" class="btn-grouped">Logout</button>
            </form>';
        } else if (isset($_SESSION['username']) && ($_SESSION['role'] == "restaurant" || $_SESSION['role'] == "retailer")) {
            echo ('
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="#" class="nav-link">Promotions</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Donations</a>
                </li>
            </ul>');
            echo '<section class="para"><p>You are logged in</p></section>';
            echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
            echo '<form action="Scripts/Php/logout.php" method="POST">
            <button type="submit" name="logout" class="btn-grouped">Logout</button>
            </form>';
        } else if (isset($_SESSION['username']) && $_SESSION['role'] == "recycler") {
            echo ('
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="#" class="nav-link">Advertisements</a>
                </li>
            </ul>');
            echo '<section class="para"><p>You are logged in</p></section>';
            echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
            echo '<form action="Scripts/Php/logout.php" method="POST">
            <button type="submit" name="logout" class="btn-grouped">Logout</button>
            </form>';
        } else if (isset($_SESSION['username']) && $_SESSION['role'] == "volunteer") {
            echo ('
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="#" class="nav-link">Advertisements</a>
                </li>
                <li class="nav-item">
                    <a href="events.php" class="nav-link">Events</a>
                </li>
            </ul>');
            echo '<section class="para"><p>You are logged in</p></section>';
            echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
            echo '<form action="Scripts/Php/logout.php" method="POST">
            <button type="submit" name="logout" class="btn-grouped">Logout</button>
            </form>';
        } else if (isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
            echo ('
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="#" class="nav-link">Manage Users</a>
                </li>
            </ul>');
            echo '<section class="para"><p>You are logged in</p></section>';
            echo ('<section class="para"><p>Hi ' . "{$_SESSION['username']}" . '. Your Role: ' . "{$_SESSION['role']}" . '</p></section>' . '<br />');
            echo '<form action="Scripts/Php/logout.php" method="POST">
            <button type="submit" name="logout" class="btn-grouped">Logout</button>
            </form>';
        } else {
            // if session is closed, it will show a signin and login option
            echo '<section class="para"><p>You are logged out</p></section>
        <button><a href="login.php" class="btn-grouped">Login</a></button>
        <button><a href="register.php" class="btn-grouped">Sign Up</a></button>';
        }
        ?>

    </nav>
</header>

<body>
    <?php
        if ($_SESSION['role'] == "volunteer") {
        echo '
        <div id="content">
            <form class="newform" method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="file" name="uploadfile" value="" />
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="upload">Post event</button>
                </div>
            </form>
        </div>
        ';

        }
    ?>

    

    <div id="display-image">

        <?php
        $query = " select * from events ";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_assoc($result)) {
        ?>
        <img src="./Images/<?php echo $data['filename']; ?>">
        <button onclick="document.location='Scripts/Php/insert.php'">RSVP</button>

        <?php
        }
        ?>

    </div>
</body>

</html>