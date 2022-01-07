<?php
if(session_id() == '') { // start session if none found
    session_start();
}

unset($_SESSION['loggedin']);     // unset $_SESSION variable for the run-time 
$_SESSION['loggedin'] = false;

// session_unset($_SESSION['loggedin']);     
// session_destroy($_SESSION['loggedin']);
// session_unset($_SESSION['email']);     
// session_destroy($_SESSION['email']);
// session_unset($_SESSION['fullname']);     
// session_destroy($_SESSION['fullname']);

// session_destroy();

header('Location: index.php');