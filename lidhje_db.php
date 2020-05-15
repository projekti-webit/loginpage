<?php 

	
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$db_connect = mysqli_connect($servername, $username, $password, $dbname);


if (!$db_connect) {
    echo "Gabim: Lidhja me bazen e te dhenave nuk eshte e mundur." . PHP_EOL;
    echo "Debugging per Admin: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

date_default_timezone_set('Europe/Tirane');

?>