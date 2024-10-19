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
    src: url('fonts/Heavitas.ttf') format('truetype');
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
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/dragao.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/coringa.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/deadpool.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/wicked.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/moana.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/morte.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/gladiador.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/image9.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
        </div>
      </div>

      <div class="carousel-item">
        <div class="container img-container">
          <img src="../../images/assiste.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-caption d-none d-md-block">
          <h5 class="carousel-caption-text">First slide label</h5>
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
  


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>