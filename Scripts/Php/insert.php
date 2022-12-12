<?php

    session_start();
    require('db.php');
?>

<html>

<head>
    <title>Insert Page</title>
</head>

<body>
    <center>
        <?php

        // Check connection
        if ($conn === false) {
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }

        $name = $_SESSION['name'];
        $email = $_SESSION['email'];

        // Performing insert query execution
        // here our table name is rsvp
        $sql = "INSERT INTO participants  VALUES ('$name',
            '$email')";



        if (mysqli_query($conn, $sql)) {
            ;

            echo "<h3>data stored in a database successfully.</h3>";

            echo nl2br("\n$name "
                . "\n$email");
        } else {
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
        ?>

    </center>
</body>

</html>