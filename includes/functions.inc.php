<?php
function checkSession() {
    $goodSession=false;
        if (!isset($_SESSION['FirstName']) || !isset($_SESSION['LastName']) || !isset($_SESSION['Email'])) {
            $goodSession=false;
        } else {
            $goodSession=true;
        }
    return $goodSession;
}

function destroySession(){
session_unset();
session_destroy();
//header("Location:login.php");
}
?>