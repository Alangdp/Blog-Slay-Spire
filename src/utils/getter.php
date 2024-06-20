<?php

include __DIR__ . '/connection.php';

function getPostagens()
{
  global $conn;

  $sql = "SELECT * FROM POSTAGENS";
  $result = mysqli_query($conn, $sql);

  $postagens = array();

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $postagens[] = $row;
    }
  }

  return $postagens;
}

function getPostagemById($id)
{
  global $conn;
  try {

    $sql = "SELECT * FROM POSTAGENS WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    $postagem = [];

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $postagem = $row;
      }
      return $postagem;
    }

    return null;
  } catch (Throwable $th) {
    return null;
  }
}
