<?php
//due to having problems putting in a function in functions.inc.php, it now gets 4 lines of code to destroy current session
session_start();
session_unset();
session_destroy();
header("Location:login.php");
?>