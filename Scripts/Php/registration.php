<?php

if (isset($_POST['signup'])) {
    // load and run the db file
    require 'db.php';

    // get inputs from form 
    $name = $_POST['fname'] . " " . $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $usertype = $_POST['usertype'];
    $role = $_POST['role'];

    // set different value depending on the user type
    switch ($role) {
        case "citizen":
            $district = $_POST['district'];
            $id = $_POST['NID'];
            $group = "";
            $company = "";
            break;
        case "municipal":
            $district = $_POST['district'];
            $id = $_POST['repID'];
            $group = "";
            $company = "";
            break;
        case "recycler":
        case "restaurant":
        case "retailer":
            $district = "";
            $id = $_POST['businessID'];
            $group = "";
            $company = $_POST['company'];
            break;
        case "volunteer":
            $district = "";
            $id = "";
            $group = $_POST['group'];
            $company = "";
            break;
        case "admin":
            $district = "";
            $id = $_POST['adminID'];
            $group = "";
            $company = "";
            break;
        default:

    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //check email validity
        header("Location: ../../register.php?q=invalidmail");
        exit();
    } elseif ($password1 !== $password2) { //check password match
        header("Location: ../../register.php?q=passunmatch");
        exit();
    } else {
        $sql = "SELECT username from registration WHERE username=?"; //sql statement to find if user exists
        $stmt = mysqli_stmt_init($conn); //check connection
        if (!mysqli_stmt_prepare($stmt, $sql)) { //protect against sql injection by user typing queries
            header("Location: ../../register.php?q=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username); //binding username parameter to statement
            mysqli_stmt_execute($stmt); //execute statement
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt); //store number of matches
            if ($resultCheck > 0) {
                header("Location: ../../register.php?q=usertaken");
                exit();
            } else { //if no error continue to add to DB
                $sql = "INSERT INTO registration (name, email, username, password, usertype, role, id, district, company_name, group_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../../register.php?q=sqlerror");
                    exit();
                } else {
                    //password hashing
                    $hashedpass = password_hash($password1, PASSWORD_DEFAULT);
                    //add information to DB
                    mysqli_stmt_bind_param($stmt, "ssssssssss", $name, $email, $username, $hashedpass, $usertype, $role, $id, $district, $company, $group);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../../login.php?q=success"); //redirect to login page after registering successfully
                    exit();

                }

            }

        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: ../../index.php");
    exit();
}

?>