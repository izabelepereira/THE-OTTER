<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Snack Bar';
include_once('../head.php');
?>
<style>
        .col-md-3 {
            display: none; /* Oculta todos os produtos inicialmente */
        }
       

@font-face {
    font-family: 'Heavitas'; /* Nome que você deseja usar para a fonte */
    src: url('../../fonts/Heavitas.ttf') format('truetype'); /* Caminho para a fonte */
    font-weight: normal; /* Ajuste o peso se necessário */
    font-style: normal; /* Ajuste o estilo se necessário */
}

        /* Estilizando o placeholder */
        #searchInput::placeholder {
            color: #e3cbbc; /* Cor do placeholder */
            opacity: 1; /* Para garantir que a cor seja totalmente opaca */
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1.1em;
        }



    </style>
<body style="background-color: #001d2f;" class="text-light">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #001d2f; padding: 1rem 2rem;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="home.php" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold;">
            <img src="../../images/theotter1.png" alt="Logo" width="145" height="22" class="d-inline-block align-middle" style="margin-left: 40%; margin-bottom: 1%;">
        </a>

      
        <!-- Botão para abrir o modal com o bi-list (visível apenas em telas pequenas) -->
        <button class="btn btn-light d-lg-none" type="button" style="border: none; color: #e3cbbc; position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background-color: transparent; " data-bs-toggle="modal" data-bs-target="#myModal">
            <i class="bi bi-list" style="font-size: 1.5rem;"></i>
        </button>

        <!-- Botão para abrir o modal do navbar (visível em telas pequenas) -->
        <button class="btn btn-light d-lg-none" type="button" style="border: none; color: #e3cbbc; background-color: transparent; box-shadow: none; padding: 0; margin-right: 1%; transform: translateY(-10%);" data-bs-toggle="modal" data-bs-target="#navbarModal">
            <i class="bi bi-person" style="font-size: 1.3rem;"></i>
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
                <button class="btn btn-light" type="button" onclick="document.getElementById('searchInput').focus();" style="border: none; color: #e3cbbc; background-color: transparent; box-shadow: none; padding: 0; margin-right: 1%; transform: translateY(-10%);">
                    <i class="bi bi-search" style="font-size: 1rem;"></i>
                </button>

                <!-- Campo de pesquisa -->
                <input type="text" id="searchInput" placeholder="Encontre um filme" style="border: none; padding: 5px; border-radius: 4px; background-color: #001d2f; color: #e3cbbc; font-family:'League Spartan', sans-serif; outline: none; ">

                <!-- Botão para abrir o modal lateral (visível em telas maiores) -->
                <button class="btn btn-light d-none d-lg-block" type="button" style="border: none; color: #e3cbbc; background-color: transparent; box-shadow: none; padding: 0; margin-right: 1%; transform: translateY(-10%);" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="bi bi-person" style="font-size: 1.3rem;"></i>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="navbarModal" tabindex="-1" aria-labelledby="navbarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #001d2f; color: #e3cbbc;">
            <div class="modal-header">
                <h5 class="modal-title" id="navbarModalLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <a class="nav-link" href="home.php" style="color: #e3cbbc;">PROGRAMAÇÃO</a>
                <a class="nav-link" href="snack.php" style="color: #e3cbbc;">SNACKBAR</a>
                <a class="nav-link" href="ver_carrinho.php" style="color: #e3cbbc;">SEU CARRINHO</a>
            </div>
        </div>
    </div>
</div>





<div style="padding-top: 80px;">
    <!-- Seu conteúdo aqui -->
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="position: fixed; top: 0; right: 0; margin: 0; height: 100%; width: 35%; transform: translateX(100%); transition: transform 0.3s ease;">
    <div class="modal-content" style="height: 100%; border-radius: 3% 0 0 3%; background-color: #001d2f;"> <!-- Bordas arredondadas somente do lado esquerdo -->
      <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h6 style="margin: 0; color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-size: 1.2em; font-weight: bold;">PERFIL</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar" style="border: none; background-color: transparent !important; color: #e3cbbc !important;"></button>
      </div>
      <div class="modal-body" style="overflow-y: auto; display: flex; flex-wrap: wrap; justify-content: space-between;">

        <!-- Mensagem de boas-vindas ou convite para login -->
        <h6 style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-size: 1.2em;">
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
                <a href="ver_carrinho.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Sua Sessão</a>
            </button>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1; margin-bottom: 40%;">
                <a href="logout.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Sair</a>
            </button>
        <?php else: ?>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1;">
                <a href="login.html" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Faça seu Login</a>
            </button>
            <button type="button" style="width: 48%; height: 30%; background-color: #0c344b; text-align: center; border-radius: 5%; margin-bottom: 5%; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.6); border: none; font-size: 3%; line-height: 1;">
                <a href="front.php" style="text-decoration: none; color: #007bff; display: block; height: 100%;">Cadastre-se</a>
            </button>
        <?php endif; ?>
      </div>
      <div class="modal-footer" style="display: flex; justify-content: flex-end;">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #6c757d; color: white; border: none;">Fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="container" style="border-radius: 5%; overflow: hidden;">
    <img id="snackImage" src="../../images/snackbar.png" alt="Imagem" style="width: 100%; height: auto; display: block; border-radius: 30px;">
</div>

<!-- Seção para Filtros -->
<div class="container mb-4 text-center" style="padding: 5%;">
    <div class="d-flex justify-content-center" style="gap: 3%; width: 100%">
        <button class="filter-button" data-category="guloseimas" style="border: none; background-color: transparent; cursor: pointer;">
            <img src="../../images/balas.png" alt="Guloseimas" style="width: 95%; height: auto; border: 2px solid transparent; border-radius: 10px;  box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.8);">
        </button>
        <button class="filter-button" data-category="snacks" style="border: none; background-color: transparent; cursor: pointer;">
            <img src="../../images/salgados.png" alt="Salgados" style="width: 95%; height: auto; border: 2px solid transparent; border-radius: 10px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.8);">
        </button>
        <button class="filter-button" data-category="bebidas" style="border: none; background-color: transparent; cursor: pointer;">
            <img src="../../images/bebidas.png" alt="Bebidas" style="width: 95%; height: auto; border: 2px solid transparent; border-radius: 10px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.8);">
        </button>
        <button class="filter-button" data-category="combos" style="border: none; background-color: transparent; cursor: pointer;">
            <img src="../../images/combos.png" alt="Combos" style="width: 95%; height: auto; border: 2px solid transparent; border-radius: 10px; box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.8);">
        </button>
    </div>
</div>


<!-- Headers de Categoria com Estilo Personalizado -->
<div id="guloseimas-header" class="category-header" style="display: none; text-align: center; color: #e3cbbc; padding: 10px; border-bottom: 2px solid #e3cbbc; border-top: 2px solid #e3cbbc; font-family: 'Heavitas', sans-serif; font-size: 15px;">
    <h2 style="margin: 0;">Guloseimas</h2>
</div>
<div id="chocolates-header" class="category-header" style="display: none; text-align: center; color: #e3cbbc; padding: 10px; border-bottom: 2px solid #e3cbbc; border-top: 2px solid #e3cbbc; font-family: 'Heavitas', sans-serif; font-size: 18px;">
    <h2 style="margin: 0;">Chocolates</h2>
</div>
<div id="snacks-header" class="category-header" style="display: none; text-align: center; color: #e3cbbc; padding: 10px; border-bottom: 2px solid #e3cbbc; border-top: 2px solid #e3cbbc; font-family:'Heavitas', sans-serif; font-size: 18px;">
    <h2 style="margin: 0;">Salgadinhos</h2>
</div>
<div id="bebidas-header" class="category-header" style="display: none; text-align: center; color: #e3cbbc; padding: 10px; border-bottom: 2px solid #e3cbbc; border-top: 2px solid #e3cbbc; font-family:'Heavitas', sans-serif; font-size: 18px;">
    <h2 style="margin: 0;">Bebidas</h2>
</div>
<div id="combos-header" class="category-header" style="display: none; text-align: center;color: #e3cbbc; padding: 10px; border-bottom: 2px solid #e3cbbc; border-top: 2px solid #e3cbbc; font-family: 'Heavitas', sans-serif; font-size: 18px;">
    <h2 style="margin: 0;">Combos</h2>
</div>

<div class="container">
    <div class="row" id="product-list">
    <?php
// Conecte-se ao banco de dados
include('../backend/conexao.php');

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Defina a categoria selecionada
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Montar a consulta
$sql = "SELECT * FROM produtos";
if ($categoria) {
    $sql .= " WHERE categoria = '" . $conn->real_escape_string($categoria) . "'";
}

// Executa a consulta
$result = $conn->query($sql);

// Exibir os produtos
if ($result && $result->num_rows > 0) {
    echo '<div class="row">'; // Adiciona uma row para alinhar os cards
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-3 mb-4" data-category="' . htmlspecialchars($row['categoria']) . '">';
        echo '<div class="card" style="border: none; border-radius: 15px; transition: transform 0.3s; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); display: flex; align-items: center; padding: 10px; margin-top: 50px; background-color: #001d2f;">'; // Container flex
        
        // Coloca a imagem à esquerda
        echo '<img src="' . htmlspecialchars($row['imagem']) . '" alt="' . htmlspecialchars($row['nome']) . '" style="border-radius: 15px; width: 100px; height: auto; margin-right: 15px;">';
        
        // Div para o corpo do card à direita
        echo '<div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column;">'; // Permitir que o corpo do card ocupe o espaço restante
        echo '<h5 class="card-title" style="color: #e3cbbc; margin: 0;">' . htmlspecialchars($row['nome']) . '</h5>'; // Título do produto
        echo '<p class="card-text" style="color: #e3cbbc; margin: 0;">R$ ' . number_format($row['preco'], 2, ',', '.') . '</p>'; // Preço do produto
        echo "<button type='button' class='btn btn-light' style='border-radius: 5%; background-color: #e3cbbc; color: #001d2f; border: none; transition: background-color 0.3s;' onclick='adicionarCarrinho(" . $row['id'] . ")'>Adicionar ao Carrinho</button>";
        echo '</div>'; // Fecha card-body
        echo '</div>'; // Fecha card
        echo '</div>'; // Fecha coluna
    }
    echo '</div>'; // Fecha a row
} else {
    echo '<p style="color: #e3cbbc; text-align: center;">Nenhum produto encontrado.</p>'; // Centraliza mensagem
}


// Fecha a conexão
$conn->close();
?>

<!-- Modal -->
<div class="modal fade" id="modalCarrinho" tabindex="-1" aria-labelledby="modalCarrinhoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #001d2f; color: #e3cbbc; border-radius: 15px;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="modalCarrinhoLabel">Carrinho</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Produto adicionado ao carrinho!
            </div>
            <div class="modal-footer" style="border-top: none;">
                <a href="ver_carrinho.php" style="text-decoration: none;">
                    <button type="button" class="btn btn-light" style="background-color: #e3cbbc; color: #001d2f; border-radius: 10px; transition: background-color 0.3s;">Ver Carrinho</button>
                </a>
            </div>
        </div>
    </div>
</div>


<script>
    function adicionarCarrinho(produtoId) {
        // Fazer a requisição AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "carrinho.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Mostrar o modal
                var modal = new bootstrap.Modal(document.getElementById('modalCarrinho'));
                modal.show();
            }
        };
        
        // Enviar o ID do produto
        xhr.send("produto_id=" + produtoId);
    }
</script>



<div class="container" style="text-align: center; color: #e3cbbc; padding: 1%; font-family: 'League Spartan'; font-size: 18px;">
<h2 style="font-family: 'Heavitas', sans-serif; margin: 0;">FURE A FILA!</h2>
    <p class="leaguespartan-text" style="font-size: 24px;">compre seus snacks!</p>
</div>
<div class="container" style="display: flex; justify-content: space-between; align-items: center; padding: 5%; border-radius: 20px;">
    <!-- Primeira imagem (comer5.png) associada a uma categoria -->
    <img id="multi-category-button" src="../../images/comer5.png" alt="Imagem Esquerda" style="width: 35%; height: auto; border-radius: 5%; margin-left: 15%; cursor: pointer;">
    
    <!-- Segunda imagem (beber5.png) associada a outra categoria -->
    <img id="beverages-button" class="filter-button" data-category="bebidas" src="../../images/beber5.png" alt="Imagem Direita" style="width: 35%; height: auto; border-radius: 5%; margin-right: 13%; cursor: pointer;">
</div>
<div class="container" style="text-align: center; color: #e3cbbc; padding: 5%; font-family: 'League Spartan'; font-size: 1.8vw;">
    <h2 style="font-family: 'Heavitas', sans-serif; margin: 0;">COMBOS</h2>
    <div class="container" style="display: flex; justify-content: flex-start; align-items: center; padding: 5%; border-radius: 10%;">
        <div class="container" style="margin-top: 0%;">
            <div class="row text-center">
                <div class="col">
                    <img src="../../images/comboz.png" alt="Imagem Esquerda" style="width: 95%; height: auto; border-radius: 5%;">
                    <p style="margin: 1% 0; color: #e3cbbc; text-align: justify; font-size: 1.2vw;">
                    O refil de pipoca é válido uma única vez, na embalagem original com o picote não violado, no dia da compra e durante o funcionamento do Snack Bar, com apresentação do cupom fiscal.                    </p>
                </div>
                <div class="col">
                    <img src="../../images/comboz.png" alt="Imagem do Meio" style="width: 95%; height: auto; border-radius: 5%;">
                    <p style="margin: 1% 0; color: #e3cbbc; text-align: justify; font-size: 1.2vw;"> Combo promocional da semana do cinema: 1 pipoca média + 1 bebida pequena e 1 choco biscuit, e leve um brinde colecionador!
                    </p>
                </div>
                <div class="col">
                    <img src="../../images/comboz.png" alt="Imagem Direita" style="width: 95%; height: auto; border-radius: 5%;">
                    <p style="margin: 1% 0; color: #e3cbbc; text-align: justify; font-size: 1.2vw;">Combo especial da semana do cinema: 1 Doritos, 1 bebida grande e 1 chocolate, e ganhe um brinde exclusivo!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container text-center">
    <button class="btn btn-light" style="background-color: #e3cbbc; color: #001d2f; border: none; border-radius: 10%; font-size: 'League Spartan', 'Sans Serif';" onclick="filtrarCombos()">
        Ver Combos
    </button>
</div>



<script>
    const filterButtons = document.querySelectorAll('.filter-button');
    const guloseimasHeader = document.getElementById('guloseimas-header');
    const chocolatesHeader = document.getElementById('chocolates-header');
    const snacksHeader = document.getElementById('snacks-header');
    const bebidasHeader = document.getElementById('bebidas-header');
    const combosHeader = document.getElementById('combos-header');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const category = button.getAttribute('data-category');

            // Ocultar todos os cabeçalhos
            guloseimasHeader.style.display = 'none';
            chocolatesHeader.style.display = 'none';
            snacksHeader.style.display = 'none';
            bebidasHeader.style.display = 'none';
            combosHeader.style.display = 'none';

            // Ocultar todos os produtos
            const allProducts = document.querySelectorAll('.col-md-3');
            allProducts.forEach(product => product.style.display = 'none');

            // Exibir cabeçalho e produtos correspondentes
            if (category === 'guloseimas') {
                guloseimasHeader.style.display = 'block'; // Exibe cabeçalho de guloseimas
                const guloseimasProducts = document.querySelectorAll('[data-category="guloseimas"], [data-category="chocolates"]');
                guloseimasProducts.forEach(product => product.style.display = 'block'); // Exibe produtos de guloseimas e chocolates
                guloseimasHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave
            } else if (category === 'snacks') {
                snacksHeader.style.display = 'block'; // Exibe cabeçalho de snacks
                const snacksProducts = document.querySelectorAll('[data-category="snacks"]');
                snacksProducts.forEach(product => product.style.display = 'block'); // Exibe produtos de snacks
                snacksHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave
            } else if (category === 'bebidas') {
                bebidasHeader.style.display = 'block'; // Exibe cabeçalho de bebidas
                const bebidasProducts = document.querySelectorAll('[data-category="bebidas"]');
                bebidasProducts.forEach(product => product.style.display = 'block'); // Exibe produtos de bebidas
                bebidasHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave
            } else if (category === 'combos') {
                combosHeader.style.display = 'block'; // Exibe cabeçalho de combos
                const combosProducts = document.querySelectorAll('[data-category="combos"]');
                combosProducts.forEach(product => product.style.display = 'block'); // Exibe produtos de combos
                combosHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave
            }
        });
    });

    // Edição: Evento de clique para a imagem comer5.png
    const multiCategoryButton = document.getElementById('multi-category-button');
    
    multiCategoryButton.addEventListener('click', () => {
        // Remover a linha que oculta a imagem comer5.png
        // multiCategoryButton.style.display = 'none'; // Esta linha foi removida

        // Ocultar todos os cabeçalhos
        guloseimasHeader.style.display = 'none';
        chocolatesHeader.style.display = 'none';
        snacksHeader.style.display = 'none';
        bebidasHeader.style.display = 'none';
        combosHeader.style.display = 'none';

        // Ocultar todos os produtos
        const allProducts = document.querySelectorAll('.col-md-3');
        allProducts.forEach(product => product.style.display = 'none');

        // Exibir os cabeçalhos e produtos das categorias "guloseimas", "chocolates", "combos", "snacks"
        guloseimasHeader.style.display = 'block'; // Exibe o cabeçalho de guloseimas
    
        // Exibir os produtos das categorias relevantes
        const selectedProducts = document.querySelectorAll('[data-category="guloseimas"], [data-category="chocolates"], [data-category="combos"], [data-category="snacks"]');
        selectedProducts.forEach(product => product.style.display = 'block'); // Exibe produtos das categorias selecionadas

        guloseimasHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave para a seção de guloseimas
    });

    // Edição: Evento de clique para a imagem beber5.png
    const beveragesButton = document.getElementById('beverages-button');

    if (beveragesButton) { // Verifica se o elemento existe
        beveragesButton.addEventListener('click', () => {
            // Ocultar a imagem beber5.png
            beveragesButton.style.display = 'none'; // Esconde a imagem

            // Ocultar todos os cabeçalhos
            guloseimasHeader.style.display = 'none';
            chocolatesHeader.style.display = 'none';
            snacksHeader.style.display = 'none';
            bebidasHeader.style.display = 'none';
            combosHeader.style.display = 'none';

            // Ocultar todos os produtos
            const allProducts = document.querySelectorAll('.col-md-3');
            allProducts.forEach(product => product.style.display = 'none');

            // Exibir o cabeçalho e produtos da categoria "bebidas"
            bebidasHeader.style.display = 'block'; // Exibe o cabeçalho de bebidas

            // Exibir os produtos da categoria "bebidas"
            const selectedBeverageProducts = document.querySelectorAll('[data-category="bebidas"]');
            selectedBeverageProducts.forEach(product => product.style.display = 'block'); // Exibe produtos da categoria "bebidas"

            bebidasHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave para a seção de bebidas
        });
    } else {
        console.error("Elemento com ID 'beverages-button' não encontrado.");
    }

    function filtrarCombos() {
        const comboButton = document.querySelector('.filter-button[data-category="combos"]');
        if (comboButton) {
            comboButton.click(); // Simula um clique no botão de filtro de combos
        }
    }
    // Evento para quando o modal é mostrado
  var modalElement = document.getElementById('myModal');
  modalElement.addEventListener('show.bs.modal', function () {
    var modalDialog = modalElement.querySelector('.modal-dialog');
    modalDialog.style.transform = 'translateX(0)';  // Move o modal para a posição original
  });

  // Evento para quando o modal é escondido
  modalElement.addEventListener('hide.bs.modal', function () {
    var modalDialog = modalElement.querySelector('.modal-dialog');
    modalDialog.style.transform = 'translateX(100%)';  // Move o modal para fora da tela
  });

  
  
</script>

</body>
</html>
