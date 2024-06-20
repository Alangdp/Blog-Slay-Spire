<?php
include_once __DIR__ . '"/../../config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

$GLOBALS['conn'] = $conn;
