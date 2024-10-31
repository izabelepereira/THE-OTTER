<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Home';
include_once('../head.php');
?>
<link rel="stylesheet" href="../css/home.css">
<style>
  .col-md-3 {
    display: none;
    /* Oculta todos os produtos inicialmente */
  }

  @font-face {
    font-family: 'Heavitas';
    /* Nome que você deseja usar para a fonte */
    src: url('../../fonts/Heavitas.ttf') format('truetype');
    /* Caminho para a fonte */
    font-weight: normal;
    /* Ajuste o peso se necessário */
    font-style: normal;
    /* Ajuste o estilo se necessário */
  }
</style>

<body style="background-color: #001d2f;" class="text-light">

<?php 
include_once '../navbar.php'; 
include 'filmes.php'; // Ajuste conforme o diretório atual
include 'carrossels.php'; // Ajuste conforme o diretório atual
  ?>

  <section class="now-showing">
    <header class="section-header">
        <h1>Em Cartaz:</h1>
    </header>
</div> 
<?php
// Incluindo o arquivo de filmes
include 'filmes.php'; // Ajuste conforme o diretório atual
include 'carrossel.php'; // Ajuste conforme o diretório atual

// Carrossel inicial
gerarCarrossel(array_slice($filmes, 0, 8));
?>

<div class="container">
    <img id="snackImage" src="../../images/programacao.png" alt="Imagem" class="snack-image">
</div>

<div>
  <section class="now-showing">
    <header class="section-header">
        <h1>em breve:</h1>
    </header>
</div> 

<?php
gerarCarrossel(array_slice($filmes, 9, 16));
?>


<div class="film-modal" id="film-modal"> 
    <div class="film-modal-content">
        <span class="film-close" id="film-close">&times;</span>
        <h2 id="film-title">Título do Filme</h2>
        <p id="film-description">Descrição do filme aqui...</p>

        <div class="button-modal">
            <button id="button1" class="info-button">Informação 1</button>
            <button id="button2" class="info-button">Informação 2</button>
        </div>

        <div class="ticket">
            <i class="bi bi-ticket"></i>
            <p class="ticket-label">Texto aqui</p>
        </div>

        <button id="add-to-cart" class="buy-button">Comprar Ingressos</button>
    </div>
</div>

    <script src="/THE-OTTER/js/home.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>