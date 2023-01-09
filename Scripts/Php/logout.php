<?php

// code to logout the user by ending the session
session_start();
session_unset();
session_destroy();

// redirect user to login after logout button pressed
header("Location: ../../index.php");

