<?php
session_start();

// Verificar se os dados estão disponíveis na sessão
if (!isset($_SESSION['nome_completo']) || !isset($_SESSION['valorTotal']) || !isset($_SESSION['metodoPagamento']) || !isset($_SESSION['itensCarrinho'])) {
    echo "Erro: Dados de pagamento não encontrados.";
    exit();
}

// Recuperar os dados da sessão
$nome_completo = $_SESSION['nome_completo'];
$valorTotal = $_SESSION['valorTotal'];
$metodoPagamento = $_SESSION['metodoPagamento'];
$dataCompra = $_SESSION['dataCompra'];
$itensCarrinho = $_SESSION['itensCarrinho'];

// Limpar a sessão após uso
session_unset();
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Confirmação';
include_once('../head.php'); // Inclui o arquivo de head (meta tags, links de CSS, etc.)
?>
<link rel="stylesheet" href="../css/confirma.css">

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
$pageLabel = "Confirmação"; 
include_once '../navbar1.php'; // Inclui o arquivo de navegação
?>

<main>
    <div class="confirmation-container">
        <h2>Pagamento realizado com sucesso!</h2>
        <p>Obrigado pela sua compra, <?php echo htmlspecialchars($nome_completo); ?>.</p>
        <p>Confira os detalhes do seu pedido:</p>

        <!-- Detalhes do Pedido -->
        <div>
            <div class="summary">
                <p><strong>Cliente:</strong> <?php echo htmlspecialchars($nome_completo); ?></p>
                <p><strong>Data:</strong> <?php echo htmlspecialchars($dataCompra); ?></p>
                <p><strong>Total Pago:</strong> R$ <?php echo number_format($valorTotal, 2, ',', '.'); ?></p>
                <p><strong>Pagamento:</strong> <?php echo ucfirst($metodoPagamento); ?></p>
            </div>
        </div>

        <!-- Mensagem sobre o Snack Bar -->
        <div class="snack-info">S
            <p>Os produtos do Snack serão retirados através do CPF do cliente. Informe o número ao balcão e recolha seu pedido.</p>
        </div>

        <a href="home.php" class="button">Voltar ao Início</a>
    </div>
</main>

</body>
</html>
