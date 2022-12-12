<?php
// Include the database configuration file
include 'db.php';

// File upload path
$targetDir = "../../Images/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $insert = $conn->query("INSERT into images (file_name, uploaded_on) VALUES ('" . $fileName . "', NOW())");
            if ($insert) {
                header("Location: ../../schedules.php?q=added");
                exit();
            } else {
                header("Location: ../../schedules.php?q=failed");
                exit();
            }
        } else {
            header("Location: ../../schedules.php?q=failed");
            exit();
        }
    } else {
        header("Location: ../../schedules.php?q=type");
        exit();
    }
} else {
    header("Location: ../../schedules.php?q=noinput");
    exit();
}

?>