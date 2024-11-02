<?php
session_start(); // Inicia a sessão
include('../backend/conexao.php'); // Inclui o arquivo de conexão

// No longer checking if the user is logged in

?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Carrinho de Compras';
include_once('../head.php');
?>
<link rel="stylesheet" href="../css/carrinho.css">

<body style="background-color: #001d2f;" class="text-light">
<?php
$pageLabel = "Seu Carrinho"; 
include '../navbar1.php';
?>

    <!-- Carrinho -->
    <div class="container" style="margin-top: 80px;">
        <h2 class="text-center" style="color: #e3cbbc;"></h2>
        <div class="row">
            <?php
            // Exibir produtos no carrinho sem verificação de login
            $sqlCarrinho = "SELECT c.quantidade, p.nome, p.preco, p.imagem, c.produto_id 
                            FROM carrinho c 
                            JOIN produtos p ON c.produto_id = p.id";
            $stmtCarrinho = $conn->prepare($sqlCarrinho);
            $stmtCarrinho->execute();
            $resultCarrinho = $stmtCarrinho->get_result();

            $total = 0; // Variável para o valor total
            if ($resultCarrinho->num_rows > 0) {
                while ($produto = $resultCarrinho->fetch_assoc()) {
                    echo '<div class="col-md-3 mb-4">';
                    echo '<div style="background-color: #001d2f; border-radius: 15px; transition: transform 0.3s; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); display: flex; align-items: center; padding: 5%; margin-top: 10%;">';
                    echo '<img src="' . htmlspecialchars($produto['imagem']) . '" class="card-img-left" alt="' . htmlspecialchars($produto['nome']) . '" style="border-radius: 15px; width: 50%; height: auto; object-fit: cover; margin-right: 3%;">';
                    echo '<div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column;">';
                    echo '<h5 class="card-title" style="color: #e3cbbc; margin: 0; font-family: \'League Spartan\', sans-serif;">' . htmlspecialchars($produto['nome']) . '</h5>';
                    echo '<p class="card-text" style="color: #e3cbbc; margin: 0; font-family: \'League Spartan\', sans-serif; font-weight: bold; font-size: 1.6em;">R$ ' . number_format($produto['preco'], 2, ',', '.') . '</p>';
                    
                    // Exibe a quantidade do produto
                    echo '<p class="card-text m-0">' . htmlspecialchars($produto['quantidade']) . '</p>';

                    echo '</div></div></div>'; // Fecha card e coluna

                    $total += $produto['preco'] * $produto['quantidade']; // Adiciona o preço do produto ao total
                }
            } 
            ?>
        </div>

        <!-- Exibir informações dos ingressos -->
       
<div class="row">
    <div class="col-12">
        <div class="informacoes-filme">
            <?php
            // Recuperar informações dos ingressos passadas pela URL
            $selectedSeats = isset($_GET['seats']) ? $_GET['seats'] : 'Nenhum assento selecionado';
            $movieName = isset($_GET['movieTitle']) ? $_GET['movieTitle'] : 'Filme Desconhecido';
            $ticketPrice = isset($_GET['ticketPrice']) ? $_GET['ticketPrice'] : 0;
            $showTime = isset($_GET['sessionTime']) ? $_GET['sessionTime'] : 'Não definido';
            $room = isset($_GET['room']) ? $_GET['room'] : 'Sala Desconhecida';

            // Exibir as informações
            echo '<h4>Filme: <span class="info-url">' . htmlspecialchars($movieName) . '</span></h4>';
            echo '<p>Preço do Ingresso: <span class="info-url">R$ ' . number_format($ticketPrice, 2, ',', '.') . '</span></p>';
            echo '<p>Horário: <span class="info-url">' . htmlspecialchars($showTime) . '</span></p>';
            echo '<p>Sala: <span class="info-url">' . htmlspecialchars($room) . '</span></p>'; // Adicionada a exibição da sala
            echo '<p>Assento Selecionado: <span id="seats-list">' . htmlspecialchars($selectedSeats) . '</span></p>';
            ?>
        </div>
    </div>
</div>


    <!-- Total no Rodapé -->
    <footer class="fixed-bottom" style="background-color: #021c2d; color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 20px; padding: 10px; width: 100%; display: flex; justify-content: center; align-items: center;">
        <div style="display: flex; align-items: center; justify-content: center;">
            <div style="margin-right: 20px;">
                SUBTOTAL: <span style="font-weight: bold;">R$ <?php echo number_format($total + (isset($ticketPrice) ? $ticketPrice : 0), 2, ',', '.'); ?></span>
            </div>
            <form class="form-inline" action="pagamento.php" method="post">
                <button type="submit" class="btn"
                    style="background-color: #021c2d; color: #1a4a67; border: none; padding: 15px 30px; font-size: 20px; font-weight: bold;">
                    CONCLUIR COMPRA
                </button>
            </form>
        </div>
    </footer>

</body>

</html>
