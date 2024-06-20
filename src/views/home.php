<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bloco de Jogos: Slay the Spire</title>
  <meta name="author" content="David Grzyb">
  <meta name="description" content="O Bloco de Jogos é um blog dedicado a análise e discussão de jogos de cartas como Slay the Spire.">

  <link rel="stylesheet" href="/src/output.css">

  <style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

    .font-family-karla {
      font-family: karla;
    }
  </style>

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>

<body class="bg-white font-family-karla">

  <?php
  include __DIR__ . '/../includes/navbar.php';
  include __DIR__ . '/../utils/getter.php';
  ?>

  <header class="w-full mx-auto bg-cover bg-center bg-no-repeat" style="background-image: url('/src/public/assets/homeArt.jpg');">
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
      <a href="#" class="block md:hidden text-base font-bold uppercase text-center justify-center items-center">
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

    <section class="w-full md:w-2/3 flex flex-col items-center px-3">
      <?php
      $postagens = getPostagens();
      foreach ($postagens as $postagem) {
      ?>
        <article class="flex flex-col shadow my-4 w-full border border-gray-200">
          <a href="/postagem/?id=<?php echo $postagem['id']; ?>" class="hover:opacity-75 flex items-center justify-center p-2">
            <img class="w-full h-auto rounded" src="/src/public/images/<?php echo $postagem['image_url']; ?>">
          </a>
          <div class="bg-white flex flex-col justify-start p-6">
            <a href="/postagem/?id=<?php echo $postagem['id']; ?>" class="text-blue-700 text-sm font-bold uppercase pb-4">Slay the Spire</a>
            <a href="/postagem/?id=<?php echo $postagem['id']; ?>" class="text-3xl font-bold hover:text-gray-700 pb-4"><?php echo $postagem['titulo']; ?></a>
            <p class="text-sm pb-3">
              Por <a href="/postagem/?id=<?php echo $postagem['id']; ?>" class="font-semibold hover:text-gray-800"><?php echo $postagem['author']; ?></a>, Publicado em <?php echo date('d/m/Y', strtotime($postagem['data_publicacao'])); ?>
            </p>
            <p class="pb-6 h-20 overflow-hidden"><?php echo $postagem['conteudo']; ?></p>
            <a href="/postagem/?id=<?php echo $postagem['id']; ?>" class="uppercase text-gray-800 hover:text-black text-ellipsis overflow-hidden	mt-4">Continue Lendo <i class="fas fa-arrow-right"></i></a>
          </div>
        </article>
      <?php
      }

      ?>
    </section>

    <aside class="w-full md:w-1/3 flex flex-col items-center px-3">
      <div class="bg-white shadow-md rounded-lg p-4 mb-4 w-full">
        <h3 class="font-semibold text-lg mb-2">Categorias</h3>
        <ul>
          <li><a href="#" class="text-blue-500 hover:underline">Notícias</a></li>
          <li><a href="#" class="text-blue-500 hover:underline">Análises</a></li>
          <li><a href="#" class="text-blue-500 hover:underline">Dicas</a></li>
          <li><a href="#" class="text-blue-500 hover:underline">Lançamentos</a></li>
          <li><a href="#" class="text-blue-500 hover:underline">Esports</a></li>
        </ul>
      </div>
      <div class="bg-white shadow-md rounded-lg p-4 mb-4 w-full">
        <h3 class="font-semibold text-lg mb-2">Siga-nos</h3>
        <div class="flex space-x-3 gap-2">
          <a href="#" class="text-blue-500 hover:underline">Facebook</a>
          <a href="#" class="text-blue-500 hover:underline">Twitter</a>
          <a href="#" class="text-blue-500 hover:underline">Instagram</a>
          <a href="#" class="text-blue-500 hover:underline">YouTube</a>
        </div>
      </div>
      <div class="bg-white shadow-md rounded-lg p-4 mb-4 w-full">
        <h3 class="font-semibold text-lg mb-2">Assine nossa Newsletter</h3>
        <form action="/src/usecases/enviaremail.php" method="POST">
          <input type="email" name="email" placeholder="Seu email" class="w-full p-4 mb-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
          <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg">Inscrever-se</button>
        </form>
      </div>
    </aside>
  </div>
</body>

</html>