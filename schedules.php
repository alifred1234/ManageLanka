<?php
session_start();

require 'Scripts/Php/db.php';

if ($_SESSION['district'] == "1") {
    $query = "SELECT * FROM district1 ORDER BY area ASC";
} else if ($_SESSION['district'] == "2") {
    $query = "SELECT * FROM district2 ORDER BY area ASC";
} else if ($_SESSION['district'] == "3") {
    $query = "SELECT * FROM district3 ORDER BY area ASC";
} else if ($_SESSION['district'] == "4") {
    $query = "SELECT * FROM district4 ORDER BY area ASC";
} else if ($_SESSION['district'] == "5") {
    $query = "SELECT * FROM district5 ORDER BY area ASC";
}

$result = mysqli_query($conn, $query);

?>

<html lang="en">

<head>
    <title>Manage Lanka</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="Bootstrap/Styles/bootstrap.css">
    <link rel="stylesheet" href="Styles/schedules.css">
    <link rel="stylesheet" href="Styles/index.css">


</head>

<?php
  $link = "";
  if ($_GET) {
    $link = $_GET['q'];
  }

  if ($link == "added") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your image has successfully been added.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  } else if ($link == "failed") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> There was an error when uploading.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else if ($link == "type") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Invalid image extension.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else if ($link == "noinput") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> You forgot to select an image.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Welcome!</strong> This is the schedules page.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>

<?php
    include "header.php";
?>
<body>
    <div class="container">
        <br />
        <br />
        <br />

        <div class="table-responsive">
            <h3 align="center">-- Areas within your District --</h3><br />
            <table id="editable_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Area</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Driver</th>
                        <th>Truck</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo '
                                    <tr>
                                    <td>' . $row["area"] . '</td>
                                    <td>' . $row["day"] . '</td>
                                    <td>' . $row["start"] . '</td>
                                    <td>' . $row["end"] . '</td>
                                    <td>' . $row["driver"] . '</td>
                                    <td>' . $row["truck"] . '</td>
                                    </tr>
                                    ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>



    <?php

    // only mcr can add images
    if (isset($_SESSION['username']) && $_SESSION['role'] == "municipal") {
        echo '
        <form class = "upload-form" action="Scripts/Php/upload.php" method="post" enctype="multipart/form-data">
            <P>Select Image File to Upload: </P>
            <input class = "file" type="file" name="file">
            <input class="btn-grouped" type="submit" name="submit" value="Upload">
        </form>
        ';
    }

    // Get images from the database
    $query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");

    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $imageURL = 'Images/' . $row["file_name"];
    ?>

    <img class="db-image" src="<?php echo $imageURL; ?>" alt="" />

    <?php }
    } else { ?>
    <p>No image(s) found...</p>
    <?php } ?>

    <script src="Bootstrap/Scripts/bootstrap1.js"></script>
    <script src="Bootstrap/Scripts/bootstrap.js"></script>

    <!-- only mcr can edit tables -->
    <?php
    if ($_SESSION['role'] == "municipal") {
        echo '<script src="Scripts/JavaScript/schedules.js"></script>';
    }
    ?>

    <script src="Plugins/plugin.js"></script>

</body>


</html>