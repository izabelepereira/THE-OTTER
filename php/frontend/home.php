<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Home';
include_once('../head.php');
?>
<style>
  .col-md-3 {
    display: none;
    /* Oculta todos os produtos inicialmente */
  }


  @font-face {
    font-family: 'Heavitas';
    /* Nome que você deseja usar para a fonte */
    src: url('fonts/Heavitas.ttf') format('truetype');
    /* Caminho para a fonte */
    font-weight: normal;
    /* Ajuste o peso se necessário */
    font-style: normal;
    /* Ajuste o estilo se necessário */
  }
</style>

<body style="background-color: #001d2f;" class="text-light">

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #001d2f; padding: 1rem 2rem;">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" href="#" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold;">
        <img src="../../images/theotter1.png" alt="Logo" width="180" height="25" class="d-inline-block align-middle">
      </a>

      <!-- Botão para colapsar o navbar apenas -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Conteúdo do navbar -->
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav me-auto" style="gap: 40px;">
          <a class="nav-link" href="programacao.html" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 20px;">PROGRAMAÇÃO</a>
          <a class="nav-link" href="snackbar.html" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 20px;">SNACKBAR</a>
          <a class="nav-link" href="sua_sessao.html" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 20px;">SUA SESSÃO</a>
        </div>
        <div class="d-flex align-items-center">
          <!-- Botão de pesquisa -->
          <button class="btn btn-light" type="button" style="border: none; color: #e3cbbc; background-color: transparent; box-shadow: none;">
            <i class="bi bi-search" style="font-size: 20px"></i>
          </button>

          <!-- Botão para abrir o modal lateral -->
          <button class="btn btn-light" type="button" style="border: none; color: #e3cbbc; background-color: transparent; box-shadow: none;" data-bs-toggle="modal" data-bs-target="#myModal">
            <i class="bi bi-list" style="font-size: 1.5rem;"></i>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <div style="padding-top: 80px;">
    <!-- Seu conteúdo aqui -->
  </div>



  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: fixed; top: 0; right: 0; margin: 0; height: 100%; width: 35%; transform: translateX(100%); transition: transform 0.3s ease-in-out;">
      <div class="modal-content" style="height: 100%; border-radius: 15px 0 0 15px; background-color: #001d2f;"> <!-- Bordas arredondadas somente do lado esquerdo -->
        <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center;">
          <h6 style="margin: 0; font-size: 1.5rem; color: #007bff;">Menu</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar" style="border: none; background-color: transparent;"></button>
        </div>
        <div class="modal-body" style="overflow-y: auto; display: flex; flex-wrap: wrap; justify-content: space-between;">

          <!-- Mensagem de boas-vindas ou convite para login -->
          <h6 style="color: #007bff;">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
              echo "Bem-vindo, " . htmlspecialchars($_SESSION['nome']) . "!"; // Nome do usuário logado
            } else {
              echo "Faça seu cadastro ou login."; // Mensagem padrão
            }
            ?>
          </h6>

          <!-- Botões no modal -->
          <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1;">
              <a href="sua_conta.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Sua Conta</a>
            </button>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1;">
              <a href="carrinho.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Seu Carrinho</a>
            </button>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1; margin-bottom: 40%;">
              <a href="sessao.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Sua Sessão</a>
            </button>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1; margin-bottom: 40%;">
              <a href="logout.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Sair</a>
            </button>
          <?php else: ?>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1;">
              <a href="login.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Faça seu Login</a>
            </button>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1;">
              <a href="cadastro.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Cadastre-se</a>
            </button>
          <?php endif; ?>
        </div>
        <div class="modal-footer" style="display: flex; justify-content: flex-end;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #6c757d; color: white; border: none;">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/mufasa.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/dragao.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/coringa.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>

        </div>
      </div>

      <!-- Adicione mais slides aqui -->
      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/deadpool.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>

        </div>
      </div>

      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/wicked.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>

        </div>
      </div>

      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/moana.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>

        </div>
      </div>

      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/morte.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>

        </div>
      </div>

      <!--carrossel-->
      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden; margin-top: 5%;">
          <img src="../../images/gladiador.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>

        </div>
      </div>

      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/image9.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>

        </div>
      </div>

      <div class="carousel-item">
        <div class="container" style="border-radius: 5%; overflow: hidden;">
          <img src="../../images/assiste.png" class="d-block w-100" alt="..." style="width: 100%; height: auto; display: block; border-radius: 30px;">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 style="font-family: 'Heavitas', sans-serif; color: #fff; text-align: left; position: absolute; bottom: 20%; left: 1%; width: 90%; font-size: 2.5em;">First slide label</h5>
        </div>
      </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



  <script>
    // Evento para quando o modal é escondido
    modalElement.addEventListener('hide.bs.modal', function() {
      var modalDialog = modalElement.querySelector('.modal-dialog');
      modalDialog.style.transform = 'translateX(100%)'; // Move o modal para fora da tela
    });
  </script>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>