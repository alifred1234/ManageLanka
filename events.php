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

<?php include 'header.php' ?>
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