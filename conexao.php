<?php
$hostname = "localhost";
$username = "root";
$password = "0258";
$dbname = "bcfarm";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
