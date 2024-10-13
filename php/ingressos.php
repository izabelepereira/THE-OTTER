<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Ingressos - Cinema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
</head>

<body style="background-color: #001d2f;" class="text-light">
    <nav class="navbar fixed-top navbar-dark" style="background-color: #001d2f;">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.html" class="navbar-brand" style="color: #e3cbbc; margin-left: 180px;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <a href="#" class="navbar-brand mx-auto">
                <img src="images/theotter1.png" alt="Logo" class="img-fluid" style="height: 20px;">
            </a>
            <a href="#" class="navbar-brand" style="color: #e3cbbc; margin-right: 200px;">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </nav>

    <div class="container" style="border-radius: 30px; overflow: hidden; margin-bottom: 20px; margin-top: 80px;">
        <img id="snackImage" src="images/filme.png" alt="Imagem" style="width: 100%; height: auto; display: block; border-radius: 30px;">
    </div>

    <div class="container d-flex flex-column flex-md-row align-items-start mt-4">
        <!-- Tabela com informações do filme à esquerda -->
        <div class="mt-4" style="width: 300px;">
            <table class="table table-borderless" style="color: #e3cbbc;">
                <tbody>
                    <tr style="border-bottom: 1px solid rgba(227, 203, 188, 0.5);">
                        <th style="padding-bottom: 8px; font-family: league spartan; ">Data de Estreia:</th>
                        <td style="padding-bottom: 8px;" id="dataEstreia"></td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(227, 203, 188, 0.5);">
                        <th style="padding-bottom: 8px; font-family: league spartan;">Distribuído por:</th>
                        <td style="padding-bottom: 8px;" id="distribuidoPor"></td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(227, 203, 188, 0.5);">
                        <th style="padding-bottom: 8px; font-family: league spartan;">Diretor:</th>
                        <td style="padding-bottom: 8px;" id="diretor"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Cartaz do filme -->
        <div class="me-md-4" style="flex: 0 0 200px;">
            <img id="cartazFilme" src="" alt="Cartaz do Filme" class="img-fluid" style="border-radius: 15px;">
        </div>

        <!-- Detalhes do filme -->
        <div class="flex-grow-1">
            <h1 id="tituloFilme" class="mt-4"></h1>
            <p id="descricaoFilme" class="mt-2"></p>

            <!-- Seleção de Data e Tipo de Ingressos -->
            <div class="filter-section d-flex">
                <div class="me-2" style="flex: 1;">
                    <label for="data" class="form-label"></label>
                    <select class="form-select" id="data" style="border: none; background-color: #0c344b; border-radius: 15px; padding: 30px; font-family: League Spartan; font-size: 15px; color: #e3cbbc;">
                        <option value="">Hoje, 23 set</option>
                        <option value="">Ter, 24 set</option>
                        <option value="">Qua, 25 set</option>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label for="tipoIngressos" class="form-label"></label>
                    <select class="form-select" id="tipoIngressos" style="border: none; background-color: #0c344b; border-radius: 15px; padding: 30px; font-family: League Spartan; font-size: 15px; color: #e3cbbc;">
                        <option value="" disabled selected>Tipo de ingresso</option>
                        <option value="inteiro">Inteiro</option>
                        <option value="meia">Meia-entrada</option>
                    </select>
                </div>
            </div>

            <div class="d-flex mt-4"> <!-- Flex container para alinhar à direita -->
    <div class="container" style="max-width: 800px;"> <!-- Largura máxima do container -->
        <div class="mb-2" style="color: #e3cbbc; font-family: League Spartan; font-size: 22px; font-weight: bold;">
            HORÁRIOS:
        </div>
        <div class="mb-4" style="color: #e3cbbc; font-family: League Spartan; font-size: 18px;">
            2D · Dublado · Sala 1
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
                <div class="card" style="background-color: #0c344b; border-radius: 15px; padding: 15px; text-align: center;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #e3cbbc; font-family: League Spartan;">Ter, 24 set, 21:00</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card" style="background-color: #0c344b; border-radius: 15px; padding: 15px; text-align: center;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #e3cbbc; font-family: League Spartan;">Ter, 24 set, 19:30</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card" style="background-color: #0c344b; border-radius: 15px; padding: 15px; text-align: center;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #e3cbbc; font-family: League Spartan;">Ter, 24 set, 21:00</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="fixed-bottom" style="background-color: #021c2d; color: #ffffff; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 20px; text-align: center; padding: 10px;">
              <form class="form-inline justify-content-center">
                <button type="submit" class="btn" 
                        style="background-color: #021c2d; color: #1a4a67; border: none; border-radius: 8px; padding: 15px 30px; font-size: 20px; font-weight: bold; transition: background-color 0.3s, color 0.3s;" 
                        onmouseover="this.style.backgroundColor='#021c2d'; this.style.color='#e3cbbc';" 
                        onmouseout="this.style.backgroundColor='#021c2d'; this.style.color='#1a4a67';">
                  PROSSEGUIR
                </button>
              </form>
            </footer>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Obter informações do filme do localStorage
            const titulo = localStorage.getItem('tituloFilme');
            const descricao = localStorage.getItem('descricaoFilme');
            const cartaz = localStorage.getItem('cartazFilme');

            // Exibir as informações na página
            document.getElementById('tituloFilme').innerText = titulo;
            document.getElementById('descricaoFilme').innerText = descricao;
            document.getElementById('cartazFilme').src = cartaz;

            // Definindo dados da tabela (exemplo)
            document.getElementById('dataEstreia').innerText = "01 de Janeiro, 2024";
            document.getElementById('distribuidoPor').innerText = "Distribuidora XYZ";
            document.getElementById('diretor').innerText = "Nome do Diretor";

            // Seleção de assentos
            const seats = document.querySelectorAll('.seat.available');
            const selectedSeats = [];

            seats.forEach(seat => {
                seat.addEventListener('click', () => {
                    seat.classList.toggle('selected');
                    const seatNumber = seat.getAttribute('data-seat');

                    if (selectedSeats.includes(seatNumber)) {
                        selectedSeats.splice(selectedSeats.indexOf(seatNumber), 1);
                    } else {
                        selectedSeats.push(seatNumber);
                    }

                    console.log('Assentos selecionados: ', selectedSeats);
                });
            });

            // Confirmação da reserva
            document.getElementById('confirmButton').addEventListener('click', () => {
                const selectedDate = document.getElementById('data').value;
                const selectedTipo = document.getElementById('tipoIngressos').value;
                alert('Data selecionada: ' + selectedDate + '\nTipo de ingresso: ' + selectedTipo);
                // Aqui você pode enviar os dados para o backend com AJAX ou formulário padrão
            });
        });
    </script>

</body>

</html>
