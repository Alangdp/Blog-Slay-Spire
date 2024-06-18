<?php
require_once '../../lib/parsedown/Parsedown.php';
require_once '../utils/connection.php'; // Importa o arquivo de conexão
require_once '../utils/getter.php'; // Importa a função getPostagemById

// Função para renderizar Markdown em HTML
function renderizarMarkdown($markdown)
{
  $parsedown = new Parsedown();
  $parsedown->setBreaksEnabled(true);
  return $parsedown->text($markdown);
}

$postagem = getPostagemById(4);

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
  <link rel="stylesheet" href="../output.css">
</head>

<body class="bg-gray-100">
  <?php include "../includes/navbar.php" ?>
  <div class="flex justify-center items-start min-h-screen">
    <div class="bg-white p-6 rounded shadow-md container w-full min-h-screen overflow-auto">
      <?php if ($imageUrl) : ?>
        <div class="w-full h-72 bg-cover bg-center mb-4 rounded-md" style="background-image: url('../public/images/<?php echo $imageUrl; ?>');"></div>
      <?php endif; ?>

      <h1 class="text-3xl font-semibold text-gray-800 mb-2"><?php echo $titulo; ?></h1>
      <p class="text-sm text-gray-600 mb-2"><?php echo $dataLancamento; ?> • <?php echo $author; ?></p>
      <div class="post-content leading-6">
        <?php echo renderizarMarkdown($conteudoMarkdown); ?>
      </div>
    </div>
  </div>
</body>

</html>
