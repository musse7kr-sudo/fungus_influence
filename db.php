<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "fungus_influence";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Kunde inte ansluta till databasen: " . mysqli_connect_error());
}
?>