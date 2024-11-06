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
gerarCarrossel(array_slice($filmes, 0, 10));
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


<!-- Modal para Detalhes do Filme -->
<div id="film-modal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <!-- Cabeçalho do Modal -->
        <span id="film-close" class="close-button">&times;</span>
        <div class="modal-body">
            <div class="modal-left">
                <img id="film-poster" src="" alt="Cartaz do Filme" />
            </div>
            <div class="modal-right">
                <h2 id="film-title">Título do Filme</h2>
                <p id="film-description">Descrição do filme aparecerá aqui.</p>
                <p id="film-room"></p> <!-- Exibe a sala do filme -->

                <!-- Opções de Ingresso, Horário e Data -->
                <div id="session-options">
                    <div class="session-group">
                        <label>Escolha o tipo de ingresso:</label><br>
                        <label><input type="radio" name="ticketType" value="inteira"> Inteira</label>
                        <label><input type="radio" name="ticketType" value="meia"> Meia</label>
                    </div>
                    <div id="document-upload" style="display: none;">
                        <label>Envie um comprovante de estudante:</label><br>
                        <input type="file" id="student-document" accept="image/*">
                        <p id="document-status" style="color: red;"></p>
                    </div>
                    <div class="session-group">
                        <label>Escolha o horário:</label><br>
                        <label><input type="radio" name="sessionTime" value="19h - Dublado"> 19h - Dublado</label>
                        <label><input type="radio" name="sessionTime" value="21h - Legendado"> 21h - Legendado</label>
                    </div>
                    <div class="session-group">
                        <label>Escolha a data:</label><br>
                        <div id="date-options"></div> <!-- Opções de data serão inseridas aqui via JS -->
                    </div>
                    <a href="assentos.php?movie_id=1&movie_name=Filme%20Exemplo&show_time=19h%20-%20Dublado&room_number=5" id="confirm-session" class="confirm-button">Escolher assentos</a>

                </div>
            </div>
        </div>
    </div>
</div>



    <script src="/THE-OTTER/js/home.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>