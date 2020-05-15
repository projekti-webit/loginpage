<?php 
	session_start();

    if( !isset($_SESSION['user_id'], $_SESSION['emri'], $_SESSION['mbiemri'], $_SESSION['email'], $_SESSION['roli']) ) {
        header('location: login.php');
    } else {
    	header('location: home.php');
    }

?>