<?php
include "../utils/connection.php";
include "../utils/extras.php";

if (validateProps()) {
  $author = $_POST['author'];
  $title = $_POST['titulo'];
  $category = $_POST['categoria'];
  $content = $_POST['conteudo'];

  $sql = "INSERT INTO POSTAGENS (author, titulo, categoria, conteudo) 
            VALUES ('$author', '$title', '$category', '$content')";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $id = mysqli_insert_id($conn);
    if (isset($_FILES['image_url'])) {
      $file = $_FILES['image_url'];
      $file_name = $file['name'];
      $file_tmp = $file['tmp_name'];
      $file_size = $file['size'];
      $file_type = $file['type'];

      $file_new_name = $id . "_" . $file_name;
      $file_destiny = "../public/images/" . $file_new_name;

      if (move_uploaded_file($file_tmp, $file_destiny)) {
        $sql_update = "UPDATE POSTAGENS SET image_url = '$file_new_name' WHERE id = '$id'";
        $result_update = mysqli_query($conn, $sql_update);

        if (!$result_update) {
          echo "Erro Atualizando a imagem: " . mysqli_error($conn);
        }
      } else {
        echo "Erro ao mover o arquivo.";
      }
    }
  } else {
    echo "Campos contento aspas duplas ou simples!" . mysqli_error($conn);
  }
}

mysqli_close($conn);
header("location: ../views/admin.php");
