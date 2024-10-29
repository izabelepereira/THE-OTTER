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
?>
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container img-container">
          <img src="../../images/mufasa.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">Mufasa: O Rei Leão</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-L">L</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/dragao.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">A Menina e o Dragão</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-L">L</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/coringa.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">Coringa: Delírio a Dois</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-18">18</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/deadpool.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">Deadpool & Wolverine</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-18">18</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/wicked.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">Wicked</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-18">18</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/moana.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">moana 2</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-L">L</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/morte.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">Até que a Sorte nos Separe 3</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-18">18</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/gladiador.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">gladiador II</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-18">18</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/image9.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
          <h1 class="assista-text">Assista agora!</h1>
          <button class="idade idade-18">18</button>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/assiste.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">faça seu login!</h5>
          <h1 class="assista-text">Assista agora!</h1>
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
<div>
  <section class="now-showing">
    <header class="section-header">
        <h1>Em Cartaz:</h1>
    </header>
</div> 
<div class="film-slider">
    <button class="nav-button prev">&#10094;</button>
    <div class="film-items">
        <!-- Filmes adicionados dinamicamente -->
        <div class="film-card" data-id="1">
            <div class="img-container">
                <img src="../../images/gladia.jpeg" alt="Filme 1">
            </div>
            <div class="card-content">
                <h3>gladiador II</h3>
                <p>2h40min</p>
                <button class="age-rating age-rating18">18</button>
            </div>
        </div>
        <div class="film-card" data-id="2">
            <div class="img-container">
                <img src="../../images/wi.jpg" alt="Filme 2">
            </div>
            <div class="card-content">
                <h3>Wicked - Parte 1</h3>
                <p>1h50min</p>
                <button class="age-rating age-rating12">12</button>
            </div>
        </div>
        <div class="film-card" data-id="3">
            <div class="img-container">
                <img src="../../images/terrifier.jpg" alt="Filme 3">
            </div>
            <div class="card-content">
                <h3>terrifier 3</h3>
                <p>2h40min</p>
                <button class="age-rating age-rating18">18</button>
            </div>
        </div>
        <div class="film-card" data-id="4">
            <div class="img-container">
                <img src="../../images/moana1.jpeg" alt="Filme 4">
            </div>
            <div class="card-content">
                <h3>moana 2</h3>
                <p>2h20min</p>
                <button class="age-rating age-rating14">14</button>
            </div>
        </div>
        <div class="film-card" data-id="4">
            <div class="img-container">
                <img src="../../images/mufasa1.jpg" alt="Filme 4">
            </div>
            <div class="card-content">
                <h3>mufasa</h3>
                <p>2h40min</p>
                <button class="age-rating age-rating14">14</button>
            </div>
        </div>
        <div class="film-card" data-id="4">
            <div class="img-container">
                <img src="../../images/sonic.jpg" alt="Filme 4">
            </div>
            <div class="card-content">
                <h3>sonic 3</h3>
                <p>1h45min</p>
                <button class="age-rating age-rating14">14</button>
            </div>
        </div>
        <div class="film-card" data-id="4">
            <div class="img-container">
                <img src="../../images/nosferatu.jpg" alt="Filme 4">
            </div>
            <div class="card-content">
                <h3>nosferatu</h3>
                <p>1h49min</p>
                <button class="age-rating age-rating14">14</button>
            </div>
        </div>
        <div class="film-card" data-id="4">
            <div class="img-container">
                <img src="../../images/kraven.jpg" alt="Filme 4">
            </div>
            <div class="card-content">
                <h3>kraven</h3>
                <p>3h7min</p>
                <button class="age-rating age-rating14">14</button>
            </div>
        </div>
        <!-- Mais filmes -->
    </div>
    <button class="nav-button next">&#10095;</button>
</div>


    
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