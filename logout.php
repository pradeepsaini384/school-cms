<?php

session_start();

// Check if the user is logged in
if (isset($_SESSION["email"])) {
    // Unset all session variables
    if (isset($_SESSION["student_id"])) {

        session_unset();

    // Destroy the session
    session_destroy();
    header("Location: studentlogin.php");
    exit();
    }
    elseif (isset($_SESSION["teacher_id"])) {
        session_unset();

        // Destroy the session
        session_destroy();
        header("Location: teacher_login.php");
        exit();
    }
    else{session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired page after logout
    header("Location: adminlogin.php");
    exit();}
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: adminlogin.php");
    exit();
}

?>
