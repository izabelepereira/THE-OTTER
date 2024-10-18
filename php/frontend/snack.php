<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Snack Bar';
include_once('../head.php');
?>
 <link rel="stylesheet" href="../css/snack.css"> <!-- Link para o arquivo CSS -->

<body style="background-color: #001d2f;" class="text-light">

<?php 
include_once '../navbar.php'; 
?>

<div class="container">
    <img id="snackImage" src="../../images/snackbar.png" alt="Imagem" class="snack-image">
</div>

<!-- Seção para Filtros -->
<div class="container mb-4 text-center filter-section">
    <div class="d-flex justify-content-center filter-buttons">
        <button class="filter-button" data-category="guloseimas">
            <img src="../../images/balas.png" alt="Guloseimas" class="filter-img">
        </button>
        <button class="filter-button" data-category="snacks">
            <img src="../../images/salgados.png" alt="Salgados" class="filter-img">
        </button>
        <button class="filter-button" data-category="bebidas">
            <img src="../../images/bebidas.png" alt="Bebidas" class="filter-img">
        </button>
        <button class="filter-button" data-category="combos">
            <img src="../../images/combos.png" alt="Combos" class="filter-img">
        </button>
    </div>
</div>

<!-- Headers de Categoria com Estilo Personalizado -->
<div id="guloseimas-header" class="category-header">
    <h3>Guloseimas</h3>
</div>
<div id="chocolates-header" class="category-header">
    <h3>Chocolates</h3>
</div>
<div id="snacks-header" class="category-header">
    <h3>Salgadinhos</h3>
</div>
<div id="bebidas-header" class="category-header">
    <h3>Bebidas</h3>
</div>
<div id="combos-header" class="category-header">
    <h3>Combos</h3>
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
                echo '<div class="col-6 col-md-3 mb-4" data-category="' . htmlspecialchars($row['categoria']) . '">'; // Exibe 2 por linha em dispositivos menores
                echo '<div class="card product-card" style="display: flex; flex-direction: column; height: 250px;">'; // Container flex

                // Coloca a imagem à esquerda e o texto à direita
                echo '<div style="display: flex; align-items: center; flex-grow: 1;">'; // Flex para imagem e texto
                echo '<img src="' . htmlspecialchars($row['imagem']) . '" alt="' . htmlspecialchars($row['nome']) . '" class="product-image">';

                // Div para o corpo do card à direita
                echo '<div class="card-body" style="margin-left: 10px;">'; // Permitir que o corpo do card tenha um espaço à esquerda
                echo '<h5 class="card-title">' . htmlspecialchars($row['nome']) . '</h5>'; // Título do produto
                echo '<p class="card-text">R$ ' . number_format($row['preco'], 2, ',', '.') . '</p>'; // Preço do produto
                echo '</div>'; // Fecha card-body
                echo '</div>'; // Fecha flex para imagem e texto

                // Botão fixo na parte inferior do card
                echo "<button class='btn btn-light btn-sm' style='align-self: flex-end; margin-top: auto;' onclick='adicionarCarrinho(" . $row['id'] . ")'>
                        <i class='bi bi-cart-plus'></i>
                    </button>";

                echo '</div>'; // Fecha card
                echo '</div>'; // Fecha coluna
            }
            echo '</div>'; // Fecha a row
        } else {
            echo '<p class="no-products">Nenhum produto encontrado.</p>'; // Centraliza mensagem
        }

        // Fecha a conexão
        $conn->close();
        ?>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalCarrinho" tabindex="-1" aria-labelledby="modalCarrinhoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCarrinhoLabel">Carrinho</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Produto adicionado ao carrinho!
            </div>
            <div class="modal-footer">
                <a href="ver_carrinho.php" style="text-decoration: none;">
                    <button type="button" class="btn btn-light">Ver Carrinho</button>
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

<div class="container footer">
    <h2>FURE A FILA!</h2>
    <p class="leaguespartan-text">compre seus snacks!</p>
</div>

<div class="container" style="display: flex; justify-content: space-between; align-items: center; padding: 5%; border-radius: 20px;">
    <!-- Primeira imagem (comer5.png) associada a uma categoria -->
    <img id="multi-category-button" src="../../images/comer5.png" alt="Imagem Esquerda" style="width: 35%; height: auto; border-radius: 5%; margin-left: 15%; cursor: pointer;">
    
    <!-- Segunda imagem (beber5.png) associada a outra categoria -->
    <img id="beverages-button" class="filter-button" data-category="bebidas" src="../../images/beber5.png" alt="Imagem Direita" style="width: 35%; height: auto; border-radius: 5%; margin-right: 13%; cursor: pointer;">
</div>

<div class="promo-container" style="margin-top: 0%;">
    <div class="row text-center">
        <div class="col">
            <img src="../../images/comboz.png" alt="Imagem Esquerda" class="combo-image">
            <p class="combo-description">
                O refil de pipoca é válido uma única vez, na embalagem original com o picote não violado, no dia da compra e durante o funcionamento do Snack Bar, com apresentação do cupom fiscal.
            </p>
        </div>
        <div class="col">
            <img src="../../images/comboz.png" alt="Imagem do Meio" class="combo-image">
            <p class="combo-description">
                Combo promocional da semana do cinema: 1 pipoca média + 1 bebida pequena e 1 choco biscuit, e leve um brinde colecionador!
            </p>
        </div>
        <div class="col">
            <img src="../../images/comboz.png" alt="Imagem Direita" class="combo-image">
            <p class="combo-description">
                Combo especial da semana do cinema: 1 Doritos, 1 bebida grande e 1 chocolate, e ganhe um brinde exclusivo!
            </p>
        </div>
    </div>
</div>
<div class="container text-center">
    <button class="btn btn-light combo-button" onclick="filtrarCombos()">
        Ver Combos
    </button>
</div>


<script src="/THE-OTTER/js/script.js" defer></script>

</body>
</html>
