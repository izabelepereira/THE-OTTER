<!DOCTYPE html>
<html lang="pt-BR">
<?php
$pageTitle = 'Assentos';
include_once('../head.php');
?>
<link rel="stylesheet" href="../css/assentos.css">

<body>
<?php
$pageLabel = "Seleção de Assentos"; 
include '../navbar1.php';
?>

<!-- Recuperar informações passadas pela URL -->

<?php
$movieId = isset($_GET['movieId']) ? $_GET['movieId'] : 'Desconhecido';
$movieName = isset($_GET['movieTitle']) ? $_GET['movieTitle'] : 'Filme Desconhecido';
$moviePrice = isset($_GET['ticketPrice']) ? $_GET['ticketPrice'] : '0';
$showTime = isset($_GET['sessionTime']) ? $_GET['sessionTime'] : 'Não definido';
$selectedSeatsString = isset($_GET['seats']) ? $_GET['seats'] : '';
$roomNumber = isset($_GET['room']) ? $_GET['room'] : 'Sala Desconhecida';
$posterPath = isset($_GET['poster']) ? $_GET['poster'] : '../../images/default_poster.jpg';
?>



<div class="assentos">
    <h3>Selecione os assentos:</h3>
    <p>Capacidade da sala - 312 assentos</p>
</div>

<div class="informacoes-filme">
    <div class="info-texto">
        <h4>Filme: <span class="info-url"><?php echo htmlspecialchars($movieName); ?></span></h4>
        <p>Preço do Ingresso: <span class="info-url">R$ <?php echo htmlspecialchars($moviePrice); ?></span></p>
        <p>Horário: <span class="info-url"><?php echo htmlspecialchars($showTime); ?></span></p>
        <p>Sala: <span class="info-url"><?php echo htmlspecialchars($roomNumber); ?></span></p>
        <p>Assentos Selecionados: <span id="seats-list"><?php echo htmlspecialchars($selectedSeatsString); ?></span></p>
    </div>
    <img src="<?php echo htmlspecialchars($posterPath); ?>" alt="Poster do Filme" class="poster-imagem">
</div>



<div class="legenda">
    <div class="legenda-item">
        <button class="assento-ocupado"></button>
        <span>Assento Ocupado</span>
    </div>
    <div class="legenda-item">
        <button class="assento-livre"></button>
        <span>Assento Livre</span>
    </div>
</div>

<div class="seat-section-container">
    <div class="letter-column">
        <h2>Filas</h2>
        <div id="letters"></div>
    </div>

    <div class="seat-map-container">
        <div class="seat-section" id="group1"></div>
        <div class="seat-section" id="group2"></div>
        <div class="seat-section" id="group3"></div>
    </div>
</div>

<div class="screen">
    <h2>Tela</h2>
</div>

<footer class="footer fixed-bottom">
    <form class="form-inline justify-content-center" onsubmit="event.preventDefault(); addToCart();">
           Prosseguir
        </button>
    </form>
</footer>

<!-- Modal para mensagem de um assento por ingresso -->
<div class="modal fade" id="modalUmAssento" tabindex="-1" aria-labelledby="modalUmAssentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-top"> <!-- Classe modal-top para sair da parte superior da tela -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUmAssentoLabel">Limite de Assentos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Apenas um assento pode ser selecionado por ingresso.
            </div>
            <div class="modal-footer">
                <a href="home.php" style="text-decoration: none;">
                    <button type="button" class="btn btn-light">Comprar mais Ingressos</button>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
const selectedSeats = [];
const alphabet = 'ABCDEFGHIJKLMN'; // Letras de A a N

// Função para criar os assentos
function createSeats(groupId, startId, numberOfSeats, seatsInRow, initialLetterIndex) {
    const seatMap = document.getElementById(groupId);
    let seatId = startId;
    let letterIndex = initialLetterIndex;
    const rows = [];

    while (seatId <= startId + numberOfSeats - 1) {
        const row = document.createElement('div');
        row.classList.add('seat-row');

        if (groupId === "group1") {
            const letter = document.createElement('div');
            letter.classList.add('row-letter');
            letter.innerText = alphabet[letterIndex];
            row.appendChild(letter); 
            letterIndex++;
        }

        for (let i = 0; i < seatsInRow && seatId <= startId + numberOfSeats - 1; i++) {
            const seat = document.createElement('div');
            seat.classList.add('seat');
            seat.dataset.seatId = seatId;
            seat.innerText = seatId;
            seat.addEventListener('click', () => toggleSeat(seat));
            row.appendChild(seat);
            seatId++;
        }

        if (groupId === "group3") {
            const letter = document.createElement('div');
            letter.classList.add('row-letter', 'group3-letter');
            letter.innerText = alphabet[letterIndex];
            row.appendChild(letter);
            letterIndex++;
        }

        rows.unshift(row);
    }

    rows.forEach(row => seatMap.appendChild(row));
}

// Função para alternar a seleção de assento e exibir modal se houver mais de um assento selecionado
function toggleSeat(seat) {
    const seatId = seat.dataset.seatId;

    if (selectedSeats.length === 1 && !selectedSeats.includes(seatId)) {
        const modal = new bootstrap.Modal(document.getElementById('modalUmAssento'));
        modal.show();
        return;
    }

    seat.classList.toggle('selected');
    if (selectedSeats.includes(seatId)) {
        selectedSeats.splice(selectedSeats.indexOf(seatId), 1);
    } else {
        selectedSeats.push(seatId);
    }
    updateSelectedSeats();
}

// Função para atualizar a lista de assentos selecionados
function updateSelectedSeats() {
    const seatsListElement = document.getElementById('seats-list');
    seatsListElement.innerText = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'Nenhum';
}

// Criação dos assentos
createSeats('group1', 1, 82, 6, 0);      // Grupo 1: Assentos 1 a 82, letras A a N à esquerda
createSeats('group2', 83, 148, 11, 0);   // Grupo 2: Assentos 83 a 230, sem letras
createSeats('group3', 231, 82, 6, 0);    // Grupo 3: Assentos 231 a 312, letras A a N à direita

</script>
</body>
</html>
