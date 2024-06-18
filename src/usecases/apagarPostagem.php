<?php
include "../utils/connection.php";
include "../utils/extras.php";

$id = $_POST['id'];

if (validateProps()) {
  $content = $_POST['id'];
  $sql = "DELETE FROM POSTAGENS WHERE id = '$id' ";
  $result = mysqli_query($conn, $sql);
}

mysqli_close($conn);
header("location: ../views/admin.php");
