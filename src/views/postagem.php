<?php

include __DIR__ . '/../utils/connection.php';
include __DIR__ . '/../utils/getter.php';
include __DIR__ . '/../utils/extras.php';

$postagem = getPostagemById($id);

if ($postagem && count($postagem) > 0) {
  $titulo = $postagem['titulo'];
  $conteudoMarkdown = $postagem['conteudo'];
  $dataLancamento = $postagem['data_publicacao'];
  $author = $postagem['author'];
  $imageUrl = $postagem['image_url'];
} else {
  $titulo = "Sem postagens encontradas";
  $conteudoMarkdown = "";
  $dataLancamento = "";
  $author = "";
  $imageUrl = "";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Exibição de Postagem</title>
  <link rel="stylesheet" href="/src/output.css">
</head>

<body class="bg-gray-100">
  <?php include __DIR__ . "/../includes/navbar.php" ?>
  <div class="flex justify-center items-start min-h-screen">
    <div class="bg-white p-6 rounded shadow-md container w-full min-h-screen overflow-auto">
      <?php if ($imageUrl) : ?>
        <div class="w-full h-72 bg-cover bg-center mb-4 rounded-md" style="background-image: url('/src/public/images/<?php echo $imageUrl; ?>');"></div>
      <?php endif; ?>

      <h1 class="text-3xl font-semibold text-gray-800 mb-2"><?php echo $titulo; ?></h1>
      <p class="text-sm text-gray-600 mb-2"><?php echo $dataLancamento; ?> • <?php echo $author; ?></p>
      <div class="post-content leading-6 parsedown ">
        <?php echo renderizarMarkdown($conteudoMarkdown); ?>
      </div>
    </div>
  </div>
</body>

</html>