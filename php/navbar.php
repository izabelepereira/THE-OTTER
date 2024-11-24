<style>
    /* Estilizando o placeholder */
    #searchInput::placeholder {
        color: #e3cbbc; /* Cor do placeholder */
        opacity: 1; /* Para garantir que a cor seja totalmente opaca */
        font-weight: bold;
        text-transform: uppercase;
        font-size: 1.1em;
    }

    /* Animação do modal */
    #myModalCard .modal-dialog {
        transform: translateX(100%);
        transition: transform 0.3s ease;
    }

    #myModalCard.show .modal-dialog {
        transform: translateX(0);
    }

    /* Fixar o ícone de perfil na tela */
    .btn-person-icon {
        position: fixed; /* Fixa o ícone na posição da tela */
        margin-top: 1%;
        right: 6%; /* Ajuste conforme necessário */
        z-index: 9999; /* Certifique-se de que ele fique acima de outros elementos */
    }

    #myModalCard .modal-dialog {
        overflow: visible;
        z-index: 1052 !important; /* Certifique-se de que o modal tenha um z-index alto */
    }

    #myModalCard .modal-body {
        position: relative;
        z-index: 1053 !important; /* Garantir que os botões fiquem acima do fundo */
    }

    #myModalCard {
        background-color: rgba(0, 0, 0, 0.5); /* Um fundo translúcido ajuda na depuração */
    }

    #myModalCard .modal-body,
    #myModalCard button {
        pointer-events: auto; /* Permitir cliques nos botões */
    }

    /* Modal ocupa tela toda em dispositivos menores */
    /* Modal ocupa a tela toda em dispositivos menores (até 576px) */
    @media (max-width: 576px) {
        #myModalCard .modal-dialog {
            width: 100% !important;
            transform: none !important; /* Remover translação para ocupar a tela toda */
        }
        #myModalCard .modal-content-card {
            border-radius: 0 !important; /* Remover as bordas arredondadas em telas menores */
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #001d2f; padding: 1rem 2rem;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="home.php" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold;">
            <img src="../../images/theotter1.png" alt="Logo" width="145" height="22" class="d-inline-block align-middle" style="margin-left: 40%; margin-bottom: 1%;">
        </a>

        <!-- Botão para abrir o modal com o bi-list (visível apenas em telas pequenas) -->
        <button class="btn btn-light d-lg-none" type="button" style="border: none; color: #e3cbbc; position: absolute; left: 5%; top: 50%; transform: translateY(-50%); background-color: transparent; " data-bs-toggle="modal" data-bs-target="#navbarModal">
            <i class="bi bi-list" style="font-size: 1.5rem;"></i>
        </button>

        <!-- Botão para abrir o modal do navbar (visível em telas pequenas) -->
        <button class="btn btn-light d-lg-none btn-person-icon" type="button" style="border: none; color: #e3cbbc; background-color: transparent; box-shadow: none; padding: 0; margin-right: 1%; transform: translateY(-10%);" data-bs-toggle="modal" data-bs-target="#myModalCard">
            <i class="bi bi-person-fill" style="font-size: 1.3rem;"></i>
        </button>

        <!-- Conteúdo do navbar -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto align-items-center" style="display: flex; gap: 5%; margin-left: 5%;">
                <a class="nav-link" href="home.php" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 1.2em;">PROGRAMAÇÃO</a>
                <a class="nav-link" href="snack.php" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 1.2em;">SNACKBAR</a>
                <a class="nav-link" href="ver_carrinho.php" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 1.2em; white-space: nowrap;">SEU CARRINHO</a>
            </div>

            <div class="d-flex align-items-center" style="margin-right: 6%;"> 
                <!-- Botão de pesquisa -->
                <button 
                    class="btn btn-light" 
                    type="button" 
                    onclick="document.getElementById('searchInput').focus();" 
                    style="border: none; color: #e3cbbc; background-color: transparent; box-shadow: none; padding: 0; margin-right: 1%; transform: translateY(-10%);">
                    <i class="bi bi-search" style="font-size: 1rem;"></i>
                </button>

                <!-- Campo de pesquisa -->
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Encontre um filme" 
                    oninput="pesquisarFilmes()" 
                    style="border: none; padding: 5px; border-radius: 4px; background-color: #001d2f; color: #e3cbbc; font-family: 'League Spartan', sans-serif; outline: none;">

                <!-- Botão para abrir o modal lateral (visível em telas maiores) -->
                <button class="btn btn-light d-none d-lg-block" type="button" style="border: none; color: #e3cbbc; background-color: transparent; box-shadow: none; padding: 0; margin-right: 1%; transform: translateY(-10%);" data-bs-toggle="modal" data-bs-target="#myModalCard">
                    <i class="bi bi-person-fill" style="font-size: 1.3rem;"></i>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Modal para icon colapsado-->
<div class="modal fade" id="navbarModal" tabindex="-1" aria-labelledby="navbarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-side" style="width: 100%; margin: 0; position: fixed; top: 0; left: 0; height: 100%; transform: translateX(-100%); transition: transform 0.5s ease-in-out;">
        <div class="modal-content-card" style="background-color: #001d2f; color: #e3cbbc; height: 100%; border-radius: 0;">
            <div class="modal-header d-flex justify-content-between" style="display: flex; justify-content: space-between; border: none;">
                <!-- Ícone de Pesquisa à esquerda -->
                <i class="bi bi-search" onclick="document.getElementById('searchInput').focus();" style="color: #e3cbbc; font-size: 1rem; cursor: pointer;  margin-left: 2%;"></i>
                <input type="text" id="searchInput" placeholder="Encontre um filme" style="border: none; padding: 5px; border-radius: 4px; background-color: #001d2f; color: #e3cbbc; font-family:'League Spartan', sans-serif; outline: none; ">

                <!-- Ícone de Fechar (X) à direita -->
                <i class="bi bi-x" style="color: #e3cbbc; font-size: 1.8rem; cursor: pointer;" 
                   data-bs-dismiss="modal" aria-label="Close"></i>
            </div>

            <div class="modal-body" style="display: flex; flex-direction: column; height: calc(100% - 60px); margin-left: 2%;">
                <a class="nav-link" href="home.php" style="color: #e3cbbc;font-weight: bold; font-family: 'League Spartan', sans-serif; margin-bottom: 10%; margin-top: 5%; font-size: 1.3em;">PROGRAMAÇÃO</a>
                <a class="nav-link" href="snack.php" style="color: #e3cbbc;font-weight: bold; font-family: 'League Spartan', sans-serif; margin-bottom: 10%; font-size: 1.3em;">SNACKBAR</a>
                <a class="nav-link" href="ver_carrinho.php" style="color: #e3cbbc; font-weight: bold; font-family: 'League Spartan', sans-serif; margin-bottom: 10%; font-size: 1.3em;">SEU CARRINHO</a>
            </div>
        </div>
    </div>
</div>


<script>
    // Anima a entrada do modal ao aparecer
    document.getElementById('navbarModal').addEventListener('show.bs.modal', function () {
        document.querySelector('.modal-dialog').style.transform = 'translateX(0)';
    });

    // Anima a saída do modal ao fechar
    document.getElementById('navbarModal').addEventListener('hide.bs.modal', function () {
        document.querySelector('.modal-dialog').style.transform = 'translateX(-100%)';
    });

     // Evento para quando o modal é mostrado
     var modalElement = document.getElementById('myModalCard');
modalElement.addEventListener('show.bs.modal', function () {
  var modalDialog = modalElement.querySelector('.modal-dialog');
  modalDialog.style.transform = 'translateX(0)';  // Move o modal para a posição original
});

modalElement.addEventListener('hide.bs.modal', function () {
  var modalDialog = modalElement.querySelector('.modal-dialog');
  modalDialog.style.transform = 'translateX(100%)';  // Move o modal para fora da tela
});

<script>
    // Função de pesquisa de filmes
    function pesquisarFilmes() {
        var input, filter, movieItems, movieTitle, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        movieItems = document.querySelectorAll('.movie-item'); // Alvo dos itens de filmes, ajuste conforme sua estrutura HTML

        for (i = 0; i < movieItems.length; i++) {
            movieTitle = movieItems[i].querySelector('.movie-title'); // Supondo que o título do filme esteja em um elemento com a classe "movie-title"
            if (movieTitle) {
                txtValue = movieTitle.textContent || movieTitle.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    movieItems[i].style.display = ""; // Exibe o item
                } else {
                    movieItems[i].style.display = "none"; // Oculta o item
                }
            }
        }
    }
</script>


</script>