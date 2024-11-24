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

// Recuperar informações passadas pela URL
$movieId = isset($_GET['movieId']) ? $_GET['movieId'] : 'Desconhecido';
$movieName = isset($_GET['movieTitle']) ? $_GET['movieTitle'] : 'Filme Desconhecido';
$moviePrice = isset($_GET['ticketPrice']) ? $_GET['ticketPrice'] : '0';
$sessionTime = isset($_GET['sessionTime']) ? $_GET['sessionTime'] : 'Não definido';
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
        <p>Horário: <span class="info-url"><?php echo htmlspecialchars($sessionTime); ?></span></p>
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

    <div class="legenda-item">
        <button class="assento-selected"></button>
        <span>Assento Selecionado</span>
    </div>
</div>


<div class="seat-section-container">
    <div class="letter-column">
        <h2>Filas</h2>
        <div id="letters"></div> <!-- Este local será preenchido com letras das filas -->
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
        <button type="submit" class="btn"
            style="background-color: #021c2d; color: #1a4a67; border: none; padding: 15px 30px; font-size: 20px; font-weight: bold;">
            PROSSEGUIR
        </button>
    </form>
</footer>

<!-- Modal para mensagem de um assento por ingresso -->
<div class="modal fade" id="modalUmAssento" tabindex="-1" aria-labelledby="modalUmAssentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-top">
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

        // Adiciona a letra da fila para os grupos 1 e 3
        // Adiciona a letra da fila apenas para o grupo 1
            if (groupId === "group1") {
                const letter = document.createElement('div');
                letter.classList.add('row-letter');
                letter.innerText = alphabet[letterIndex];
                row.appendChild(letter);
                letterIndex++;
            }


        // Criação dos assentos
        for (let i = 0; i < seatsInRow && seatId <= startId + numberOfSeats - 1; i++) {
            const seat = document.createElement('div');
            seat.classList.add('seat');
            seat.dataset.seatId = seatId;
            seat.innerText = seatId;
            seat.addEventListener('click', () => toggleSeat(seat)); // Evento de clique
            row.appendChild(seat);
            seatId++;
        }

        rows.unshift(row); // Adiciona a fila ao topo da lista
    }

    // Adiciona todas as filas ao grupo de assentos
    rows.forEach(row => seatMap.appendChild(row));
}

// Função para alternar a seleção de assento
function toggleSeat(seat) {
    const seatId = seat.dataset.seatId;

    if (selectedSeats.length === 1 && !selectedSeats.includes(seatId)) {
        const modal = new bootstrap.Modal(document.getElementById('modalUmAssento'));
        modal.show();
        return;
    }

    seat.classList.toggle('selected');
    if (selectedSeats.includes(seatId)) {
        selectedSeats.splice(selectedSeats.indexOf(seatId), 1); // Remove o assento
    } else {
        selectedSeats.push(seatId); // Adiciona o assento
    }
    updateSelectedSeats();
}

// Função para atualizar a lista de assentos selecionados
function updateSelectedSeats() {
    const seatsListElement = document.getElementById('seats-list');
    seatsListElement.innerText = selectedSeats.length > 0 ? selectedSeats.join(', ') : 'Nenhum';
}

// Função para carregar os assentos ocupados do backend
function loadSelectedSeats() {
    const movieId = '<?php echo htmlspecialchars($movieId); ?>';  // Passando o movieId para o JS via PHP

    fetch(`/THE-OTTER/php/backend/getSelectedSeats.php?movieId=${movieId}`)
    .then(response => response.json())
    .then(data => {
        console.log('Assentos ocupados:', data);
        if (data.success && data.seats) {
            const occupiedSeatsArray = data.seats;

            // Marcar os assentos ocupados
            occupiedSeatsArray.forEach(seatId => {
                const seat = document.querySelector(`[data-seat-id="${seatId}"]`);
                if (seat) {
                    seat.classList.add('assento-ocupado');
                    seat.disabled = true; // Desabilitar o assento, para que não seja selecionado
                }
            });
        } else {
            console.error('Erro ao carregar os assentos:', data.message);
        }
    })
    .catch(error => {
        console.error('Erro ao carregar os assentos:', error);
    });
}


// Função para adicionar ao carrinho
function addToCart() {
    const selectedSeatsString = selectedSeats.join(',');

    if (selectedSeats.length === 0) {
        alert('Você deve selecionar ao menos um assento!');
        return;
    }

    console.log("Assentos selecionados: ", selectedSeatsString);

    const movieId = '<?php echo htmlspecialchars($movieId); ?>';
    const movieName = '<?php echo htmlspecialchars($movieName); ?>';
    const moviePrice = '<?php echo htmlspecialchars($moviePrice); ?>';
    const showTime = '<?php echo htmlspecialchars($sessionTime); ?>';
    const roomNumber = '<?php echo htmlspecialchars($roomNumber); ?>';
    const posterPath = '<?php echo htmlspecialchars($posterPath); ?>';

    // Garantir que todos os dados estão sendo passados corretamente
    console.log("Id do filme:" + movieId);
    console.log("Preço do filme:" + moviePrice);
    console.log("Hora do filme:" + showTime);
    console.log("Número da sala do filme:" + roomNumber);
    console.log("Imagem do filme:" + posterPath);

    fetch('../backend/addToCart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'movieId': movieId,
            'movieName': movieName,
            'moviePrice': moviePrice,
            'sessionTime': showTime,
            'roomNumber': roomNumber,
            'seats': selectedSeatsString,
            'posterPath': posterPath
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'ver_carrinho.php';
        } else {
            alert(data.message || 'Erro ao adicionar ao carrinho');
        }
    })
    .catch(error => console.error('Erro ao se comunicar com o servidor. Tente novamente mais tarde.'));
}

 // Criando os assentos ao carregar a página

createSeats('group1', 1, 82, 6, 0);      // Grupo 1: Assentos 1 a 82, letras A a N à esquerda
createSeats('group2', 83, 148, 11, 0);   // Grupo 2: Assentos 83 a 148, sem letras
createSeats('group3', 231, 82, 6, 0);    // Grupo 3: Assentos 231 a 312, letras A a N à direita

// Carregar os assentos selecionados do backend
loadSelectedSeats();

    </script>

</body>
</html>
