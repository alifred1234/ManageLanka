<?php

if (isset($_POST['login'])) { //check if fields are empty

    require 'db.php';

    $cred = $_POST['cred'];
    $pass = $_POST['password'];


    $sql = "SELECT * FROM registration WHERE username=?;"; //query to search DB
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../../login.php?q=conn");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $cred); //binding parameters
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $passcheck = password_verify($pass, $row['password']); //checking if passwords match
            if ($passcheck == false) {
                //credentials dont match
                header("Location: ../../login.php?q=wrongpass");
                exit();
            } else if ($passcheck == true) {
                //credentials match, create a session
                session_start();

                $_SESSION = $row;

                header("Location: ../../index.php?q=success"); //redirect to main page
                exit();

            } else {
                header("Location: ../../login.php?q=sqlerror"); //redirect to login page again
                exit();
            }
        } else {
            header("Location: ../../login.php?q=invalidusername");
            exit();
        }
    }


} else {
    header("Location: ../index.html");
    exit();
}

?>