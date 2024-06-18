<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bloco de Jogos: Slay the Spire</title>
  <meta name="author" content="David Grzyb">
  <meta name="description" content="O Bloco de Jogos é um blog dedicado a análise e discussão de jogos de cartas como Slay the Spire.">

  <link rel="stylesheet" href="../output.css">

  <style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

    .font-family-karla {
      font-family: karla;
    }
  </style>

  <!-- AlpineJS -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>

<body class="bg-white font-family-karla">

  <?php include '../includes/navbar.php'; ?>

  <header class="w-full mx-auto bg-cover bg-center bg-no-repeat" style="background-image: url('../public/assets/homeArt.jpg');">
    <div class="flex flex-col items-center py-12">
      <a class="font-bold text-white uppercase hover:text-5xl hover:opacity-80" href="#">
        Slay The Spire
      </a>
      <p class="text-lg text-white">
        Análise e discussão.
      </p>
    </div>
  </header>

  <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
      <a href="#" class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center" @click="open = !open">
        Categorias <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
      </a>
    </div>
    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
      <div class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
        <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Slay the Spire</a>
        <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Build</a>
        <a href="#" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Personagens</a>
      </div>
    </div>
  </nav>

  <div class="container mx-auto flex flex-wrap py-6">

    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

      <?php
      include '../utils/connection.php';
      include '../utils/getter.php';


      // Obter todas as postagens
      $postagens = getPostagens();

      // Exibir postagens
      foreach ($postagens as $postagem) {
      ?>
        <article class="flex flex-col shadow my-4 w-full">
          <!-- Article Image -->
           
          <a href="#" class="hover:opacity-75 flex items-center justify-center">
            <img class="w-80 h-auto rounded" src="../public/images/<?php echo $postagem['image_url']; ?>">
          </a>
          <div class="bg-white flex flex-col justify-start p-6">
            <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Slay the Spire</a>
            <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4"><?php echo $postagem['titulo']; ?></a>
            <p class="text-sm pb-3">
              Por <a href="#" class="font-semibold hover:text-gray-800"><?php echo $postagem['author']; ?></a>, Publicado em <?php echo date('d/m/Y', strtotime($postagem['data_publicacao'])); ?>
            </p>
            <p class="pb-6 h-20 overflow-hidden"><?php echo $postagem['conteudo']; ?></p>
            <a href="#" class="uppercase text-gray-800 hover:text-black text-ellipsis overflow-hidden	">Continue Lendo <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
      <?php
      }

      ?>

      <!-- Pagination -->
      <div class="flex items-center py-8 gap-2">
        <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center flex items-center w-fit">
          < Anterior </a>
            <a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
            <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center ">2</a>
            <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center items-center w-fit">Proximo > </a>
      </div>
    </section>

    <!-- Sidebar (opcional, dependendo do layout desejado) -->
    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">
      <!-- Aqui pode ser adicionado conteúdo adicional, como widgets, etc. -->
    </aside>

  </div>

</body>

</html>