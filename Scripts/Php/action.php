<?php

require 'db.php';

session_start();

// replace with the actual session////////////////////////////////////////////////////////////////////////////
// $_SESSION['district'] = "2";

$input = filter_input_array(INPUT_POST);

$day = mysqli_real_escape_string($conn, $input["day"]);
$start = mysqli_real_escape_string($conn, $input["start"]);
$end = mysqli_real_escape_string($conn, $input["end"]);
$driver = mysqli_real_escape_string($conn, $input["driver"]);
$truck = mysqli_real_escape_string($conn, $input["truck"]);

if ($input["action"] === 'edit' && $day != "" && $start != "" && $end != "" && $driver != "" && $truck != "" ) {

    if ($_SESSION['district'] == "1") {
        $query = "UPDATE district1 SET day = '" . $day . "', start = '" . $start . "', end = '" . $end . "', driver = '" . $driver . "', truck = '" . $truck . "' WHERE area = '" . $input["area"] . "'";
    } else if ($_SESSION['district'] == "2") {
        $query = "UPDATE district2 SET day = '" . $day . "', start = '" . $start . "', end = '" . $end . "', driver = '" . $driver . "', truck = '" . $truck . "' WHERE area = '" . $input["area"] . "'";
    } else if ($_SESSION['district'] == "3") {
        $query = "UPDATE district3 SET day = '" . $day . "', start = '" . $start . "', end = '" . $end . "', driver = '" . $driver . "', truck = '" . $truck . "' WHERE area = '" . $input["area"] . "'";
    } else if ($_SESSION['district'] == "4") {
        $query = "UPDATE district4 SET day = '" . $day . "', start = '" . $start . "', end = '" . $end . "', driver = '" . $driver . "', truck = '" . $truck . "' WHERE area = '" . $input["area"] . "'";
    } else if ($_SESSION['district'] == "5") {
        $query = "UPDATE district5 SET day = '" . $day . "', start = '" . $start . "', end = '" . $end . "', driver = '" . $driver . "', truck = '" . $truck . "' WHERE area = '" . $input["area"] . "'";
    }

    mysqli_query($conn, $query);

}

echo json_encode($input);

?>