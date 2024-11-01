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

?>

<div class="assentos">
    <h3>Selecione os assentos:</h3>
    <p>Capacidade da sala - 312 assentos</p>
</div>

<div class="informacoes-filme">
    <h4>Filme: <span class="info-url"><?php echo htmlspecialchars($movieName); ?></span></h4>
    <p>Preço do Ingresso: <span class="info-url">R$ <?php echo htmlspecialchars($moviePrice); ?></span></p>
    <p>Horário: <span class="info-url"><?php echo htmlspecialchars($showTime); ?></span></p>
    <p>Assentos Selecionados: <span id="seats-list"><?php echo htmlspecialchars($selectedSeatsString); ?></span></p>
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
        <div class="seat-section">
            <div class="seat-map" id="group1"></div>
        </div>

        <div class="seat-section">
            <div class="seat-map" id="group2"></div>
        </div>

        <div class="seat-section">
            <div class="seat-map" id="group3"></div>
        </div>
    </div>
</div>

<div class="screen">
    <h2>Tela</h2>
</div>

<footer class="footer fixed-bottom">
    <form class="form-inline justify-content-center" onsubmit="event.preventDefault(); addToCart();">
        <button type="submit" class="btn btn-add-to-cart">
           Prosseguir
        </button>
    </form>
</footer>

<script>
const selectedSeats = [];
const alphabet = 'ABCDEFGHIJKLMN'; // Letras de A a N

function createSeats(groupId, startId, numberOfSeats, seatsInRow, initialLetterIndex) {
    const seatMap = document.getElementById(groupId);
    let seatId = startId;
    let letterIndex = initialLetterIndex;

    const rows = [];

    while (seatId <= startId + numberOfSeats - 1) {
        const row = document.createElement('div');
        row.classList.add('seat-row');

        // Condicional para exibir a letra do lado esquerdo ou direito
        if (groupId === "group1") {
            const letter = document.createElement('div');
            letter.classList.add('row-letter');
            letter.innerText = alphabet[letterIndex];
            row.appendChild(letter); // Adiciona a letra no início
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
            row.appendChild(letter); // Adiciona a letra no final
            letterIndex++;
        }

        rows.unshift(row);
    }

    rows.forEach(row => seatMap.appendChild(row));
}

function toggleSeat(seat) {
    const seatId = seat.dataset.seatId;
    seat.classList.toggle('selected');
    if (selectedSeats.includes(seatId)) {
        selectedSeats.splice(selectedSeats.indexOf(seatId), 1);
    } else {
        selectedSeats.push(seatId);
    }
    updateSelectedSeats();
}

function updateSelectedSeats() {
    const seatsListElement = document.getElementById('seats-list');
    if (selectedSeats.length > 0) {
        seatsListElement.innerText = selectedSeats.join(', ');
    } else {
        seatsListElement.innerText = 'Nenhum';
    }
}

function addToCart() {
    if (selectedSeats.length === 0) {
        alert('Por favor, selecione pelo menos um assento.');
        return;
    }

    const selectedSeatsString = selectedSeats.join(',');
    const movieName = '<?php echo addslashes($movieName); ?>';
    const moviePrice = '<?php echo addslashes($moviePrice); ?>';
    const showTime = '<?php echo addslashes($showTime); ?>';
    const selectedSeatsParam = `seats=${encodeURIComponent(selectedSeatsString)}&movie=${encodeURIComponent(movieName)}&price=${encodeURIComponent(moviePrice)}&time=${encodeURIComponent(showTime)}`;

    // Redireciona ou processa a compra conforme necessário
    window.location.href = `carrinho.php?${selectedSeatsParam}`;
}

// Criar assentos para todos os grupos
createSeats('group1', 1, 82, 6, 0);      // Grupo 1: Assentos 1 a 82, letras A a N à esquerda
createSeats('group2', 83, 148, 11, 0);   // Grupo 2: Assentos 83 a 230, sem letras
createSeats('group3', 231, 82, 6, 0);    // Grupo 3: Assentos 231 a 312, letras A a N à direita
</script>

</body>
</html>