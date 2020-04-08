<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_ordering";

$ip_public = "http://192.168.100.9";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

try {
    $dbh = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);
} catch (PDOException $e) {
    echo "Koneksi ke database gagal: ".$e->getMessage();
}
?>