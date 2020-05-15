<?php 

    session_start();
    session_unset();
    session_destroy();

    // redirekt ne login page
    header("location:index.php");
    exit();

?>