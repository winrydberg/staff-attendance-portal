<?php 

if(session_id() == '') { // start session if none found
    session_start();
}

// if (isset($_SESSION['loggedin']) && (time() - $_SESSION['loggedin'] > 1800)) {
//     // last request was more than 30 minutes ago
//     session_unset($_SESSION['loggedin']);     // unset $_SESSION variable for the run-time 
//     session_destroy($_SESSION['loggedin']);   // destroy session data in storage
// } 

if (!isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] == true) {
    header('Location:index.php');
}

?>