<?php
include "../utils/connection.php";
include "../utils/extras.php";

if (validateProps()) {
  $id = $_POST['id'];
  $author = $_POST['author'];
  $title = $_POST['titulo'];
  $category = $_POST['categoria'];
  $content = $_POST['conteudo'];

  $sql = "UPDATE POSTAGENS SET author = '$author', titulo = '$title', categoria = '$category', conteudo = '$content' WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  if (isset($_FILES['image_url'])) {
    $file = $_FILES['image_url'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_type = $file['type'];

    $file_new_name = $id . "_" . $file_name . ".png";
    $file_destiny = "../public/images/" . $file_new_name . "";

    if (move_uploaded_file($file_tmp, $file_destiny)) {
      $sql = "UPDATE POSTAGENS SET image_url = '$file_new_name' WHERE id = '$id'";
      $result = mysqli_query($conn, $sql);
    }
  }
}

mysqli_close($conn);

header("location: ../views/admin.php");
