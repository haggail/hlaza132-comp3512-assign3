<?php
//function to check session state variables
function checkSession() {
    $goodSession=false;
        if (!isset($_SESSION['User']) || !isset($_SESSION['FirstName']) || !isset($_SESSION['LastName']) || !isset($_SESSION['Email'])) {
            $goodSession=false;
        } else {
            $goodSession=true;
        }
    return $goodSession;
}
?>