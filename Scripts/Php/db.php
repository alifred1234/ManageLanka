<?php

// // // actual database connection
// $servername = "localhost";
// $dbusername = "id19880753_superadmin";
// $pass = "CB009394@student";
// $database = "id19880753_main_db";

// // XAMPP database connection
$servername = "localhost";
$dbusername = "root";
$pass = "";
$database = "managelanka";

// create connection
$conn = mysqli_connect($servername, $dbusername, $pass, $database);

// check connection
if(!$conn){
    die("Connection Failed : " .mysqli_connect_error()); 
}

?>