<!DOCTYPE html>
<html lang="pt-BR">

<?php
include __DIR__ . '/../utils/connection.php';
include __DIR__ . '/../utils/getter.php';
include __DIR__ . '/../utils/extras.php';

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administração do Blog</title>
  <meta name="author" content="David Grzyb">
  <meta name="description" content="Administração do Blog - Cadastro e Edição de Postagens">
  <link rel="stylesheet" href="/src/output.css">

  <style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

    .font-family-karla {
      font-family: karla;
    }
  </style>

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>

<body class="bg-white font-family-karla">

  <?php
  include __DIR__ . '/../includes/navbar.php'
  ?>

  <header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
      <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="#">
        Administração do Blog
      </a>
      <p class="text-lg text-gray-600">
        Gerencie suas postagens e cadastre novos conteúdos.
      </p>
    </div>
  </header>

  <div class="container mx-auto flex flex-wrap py-6">

    <div class="container mx-auto mt-8 p-4 border border-gray-200 rounded">
      <h1 class="text-2xl font-semibold mb-4">Nova Postagem</h1>
      <form action="/src/usecases/criarPostagem.php" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
          <label for="author" class="block text-sm font-semibold text-gray-600">Autor:</label>
          <input type="text" id="author" name="author" class="w-full px-3 py-2 border rounded-md text-sm outline-none" required>
        </div>
        <div class="mb-4">
          <label for="titulo" class="block text-sm font-semibold text-gray-600">Título:</label>
          <input type="text" id="titulo" name="titulo" class="w-full px-3 py-2 border rounded-md text-sm outline-none" required>
        </div>
        <div class="mb-4">
          <label for="categoria" class="block text-sm font-semibold text-gray-600">Categoria:</label>
          <input type="text" id="categoria" name="categoria" class="w-full px-3 py-2 border rounded-md text-sm outline-none">
        </div>
        <div class="mb-4">
          <label for="conteudo" class="block text-sm font-semibold text-gray-600">Conteúdo:</label>
          <textarea id="conteudo" name="conteudo" rows="6" class="w-full px-3 py-2 border rounded-md text-sm outline-none" required></textarea>
        </div>
        <div class="mt-6 mb-4">
          <h2 class="text-xl font-semibold mb-2">Pré-visualização do Conteúdo</h2>
          <div id="preview" class="border border-gray-300 p-4 rounded-md"></div>
        </div>
        <div class="mb-4">
          <label for="image_url" class="block text-sm font-semibold text-gray-600">Escolha uma Imagem:</label>
          <input type="file" id="image_url" name="image_url" class="hidden" accept="image/*">
          <div class="flex items-center">
            <div class="mt-2">
              <button type="button" id="choose_image_btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition duration-200">Escolher Imagem</button>
              <p id="image_filename" class="text-sm text-gray-500 mt-2"></p>
            </div>
            <div id="image_preview" class="mt-4"></div>
          </div>
        </div>
        <div class="mt-6">
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition duration-200 w-full">Publicar Postagem</button>
        </div>
      </form>
    </div>

    <section class="w-full md:w-full flex flex-col items-center px-3 mb-6 mt-6 p-4 border border-gray-200 rounded">
      <h2 class="text-2xl mb-4 text-gray-800 font-semibold">Edição de Postagens</h2>
      <div class="w-full bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <table class="table-auto w-full">
          <thead>
            <tr>
              <th class="px-4 py-2">Título</th>
              <th class="px-4 py-2">Categoria</th>
              <th class="px-4 py-2">Conteúdo</th>
              <th class="px-4 py-2">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $postagens = getPostagens();
            foreach ($postagens as $postagem) : ?>
              <tr class="h-20">
                <td class="border px-4 py-2"><?php echo $postagem['titulo']; ?></td>
                <td class="border px-4 py-2"><?php echo $postagem['categoria']; ?></td>
                <td class="border px-4 py-2 "><?php echo renderizarMarkdown($postagem['conteudo']);?></td>
                <td class="border px-4 py-2 flex gap-4 items-center">
                  <button class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline" type="button">
                    Detalhes
                  </button>
                  <button class="bg-yellow-500 hover:bg-blue-400 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline" type="button" onclick="openEditModal(<?php echo $postagem['id']; ?>)">
                    Editar
                  </button>
                  <form class="" action="/src/usecases/apagarPostagem.php" method="POST">
                    <input type="text" name="id" hidden value="<?php echo $postagem['id']; ?>">
                    <button class="bg-red-500 hover:bg-red-400 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline" type="submit">
                      Excluir
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
      <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Editar Postagem</h2>
        <form action="/src/usecases/editarPostagem.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="editId" name="id">
          <div class="mb-4">
            <label for="editAuthor" class="block text-sm font-semibold text-gray-600">Autor:</label>
            <input type="text" id="editAuthor" name="author" class="w-full px-3 py-2 border rounded-md text-sm outline-none" required>
          </div>
          <div class="mb-4">
            <label for="editTitle" class="block text-sm font-semibold text-gray-600">Título:</label>
            <input type="text" id="editTitle" name="titulo" class="w-full px-3 py-2 border rounded-md text-sm outline-none" required>
          </div>
          <div class="mb-4">
            <label for="editCategory" class="block text-sm font-semibold text-gray-600">Categoria:</label>
            <input type="text" id="editCategory" name="categoria" class="w-full px-3 py-2 border rounded-md text-sm outline-none">
          </div>
          <div class="mb-4">
            <label for="editContent" class="block text-sm font-semibold text-gray-600">Conteúdo:</label>
            <textarea id="editContent" name="conteudo" rows="6" class="w-full px-3 py-2 border rounded-md text-sm outline-none" required></textarea>
          </div>
          <div class="mb-4">
            <label for="editImage" class="block text-sm font-semibold text-gray-600">Escolha uma Nova Imagem:</label>
            <input type="file" id="editImage" name="image_url" class="hidden" accept="image/*">
            <div class="flex items-center">
              <button type="button" id="choose_edit_image_btn" class="px-4 py-2 bg-blue-600 w-full text-white rounded-md hover:bg-blue-500 transition duration-200">Escolher Imagem</button>
              <p id="edit_image_filename" class="text-sm text-gray-500 ml-2"></p>
            </div>
            <div id="edit_image_preview" class="mt-4">
              <img id="edit_preview_img" class="max-w-xs max-h-40 mt-2" src="" alt="Preview da Imagem">
            </div>
          </div>
          <div class="flex justify-center">
            <button type="button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md mr-2 hover:bg-gray-400 transition duration-200" onclick="document.getElementById('editModal').classList.add('hidden')">Cancelar</button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition duration-200">Salvar Alterações</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function updatePreview() {
      var conteudoMarkdown = document.getElementById('conteudo').value;
      var conteudoHTML = marked.parse(conteudoMarkdown);
      document.getElementById('preview').innerHTML = conteudoHTML;
    }

    document.getElementById('conteudo').addEventListener('input', function() {
      updatePreview();
    });

    updatePreview();
  </script>

  <script>
    const fileInput = document.getElementById('image_url');
    const chooseImageButton = document.getElementById('choose_image_btn');
    const imagePreview = document.getElementById('image_preview');
    const imageFilename = document.getElementById('image_filename');
    
    chooseImageButton.addEventListener('click', function() {
      fileInput.click();
    });

    fileInput.addEventListener('change', function() {
      const file = this.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.createElement('img');
          img.src = e.target.result;
          img.classList.add('max-w-xs', 'max-h-40', 'mt-2');
          img.alt = file.name;

          imagePreview.innerHTML = '';

          imagePreview.appendChild(img);
        }

        reader.readAsDataURL(file);
      } else {
        imagePreview.innerHTML = '';
        imageFilename.textContent = '';
      }
    });
  </script>

  <script>
    function openEditModal(postId) {
      const postagem = <?php echo json_encode($postagem); ?>;

      document.getElementById('editId').value = postId;
      document.getElementById('editAuthor').value = postagem.author;
      document.getElementById('editTitle').value = postagem.titulo;
      document.getElementById('editCategory').value = postagem.categoria;
      document.getElementById('editContent').value = postagem.conteudo;

      document.getElementById('editModal').classList.remove('hidden');
    }
  </script>

  <script>
    const editFileInput = document.getElementById('editImage');
    const editChooseImageButton = document.getElementById('choose_edit_image_btn');
    const editImagePreview = document.getElementById('edit_image_preview');
    const editImageFilename = document.getElementById('edit_image_filename');
    const editPreviewImg = document.getElementById('edit_preview_img');
    editChooseImageButton.addEventListener('click', function() {
      editFileInput.click();
    });

    editFileInput.addEventListener('change', function() {
      const file = this.files[0];

      if (file) {
        editImageFilename.textContent = `Nome do arquivo: ${file.name}`;

        const reader = new FileReader();

        reader.onload = function(e) {
          editPreviewImg.src = e.target.result;
          editImagePreview.classList.remove('hidden');
        }

        reader.readAsDataURL(file);
      } else {
        editPreviewImg.src = '';
        editImagePreview.classList.add('hidden');
        editImageFilename.textContent = '';
      }
    });
  </script>


</body>

</html>