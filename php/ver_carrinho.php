<?php
session_start(); // Inicia a sessão
include('conexao.php'); // Inclui o arquivo de conexão

// Verifica se o usuário está logado
$usuario_id = $_SESSION['usuario_id'] ?? null; // Obtém o ID do usuário da sessão

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #001d2f;" class="text-light">
<nav class="navbar fixed-top navbar-dark" style="background-color: #001d2f;">
  <div class="container d-flex justify-content-between align-items-center">
    <a href="snack.php" class="navbar-brand" style="color: #e3cbbc; margin-left: 180px;">
      <i class="fas fa-arrow-left"></i>
    </a>
    <span class="navbar-brand mx-auto" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-size: 18px;">
      seu carrinho
    </span>
    <a href="#" class="navbar-brand" style="color: #e3cbbc; margin-right: 200px;">
      <i class="fas fa-times"></i>
    </a>
  </div>
</nav>

<!-- Carrinho -->
<div class="container" style="margin-top: 80px;">
    <h2 class="text-center" style="color: #e3cbbc;"></h2>
    <div class="row">
    <?php
    // Verificar se o usuário está logado
    if ($usuario_id) {
        // Consultar os produtos no carrinho do usuário
        $sqlCarrinho = "SELECT c.quantidade, p.nome, p.preco, p.imagem, c.produto_id 
                        FROM carrinho c 
                        JOIN produtos p ON c.produto_id = p.id 
                        WHERE c.usuario_id = ?";
        $stmtCarrinho = $conn->prepare($sqlCarrinho);
        $stmtCarrinho->bind_param("i", $usuario_id);
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
        } else {
            echo '<div class="col-12 text-center" style="color: #e3cbbc; margin-top: 5%;">';
            echo '<h3 style="margin: 0; font-size: 1.9em; font-family: \'League Spartan\', sans-serif;">Seu carrinho está vazio.</h3>';
            echo '<p style="color: #e3cbbc; font-size: 1.2em;">Adicione produtos para começar a comprar!</p>';
            echo '<a href="snack.php" class="btn btn-light" style="background-color: #e3cbbc; color: #001d2f; border-radius: 10px; margin-top: 2%; font-family: \'League Spartan\', sans-serif;">Voltar às Compras</a>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-12 text-center" style="color: #e3cbbc; margin-top: 5%;">';
        echo '<h3 style="margin: 0; font-size: 1.9em; font-family: \'League Spartan\', sans-serif;">Você precisa estar logado para ver seu carrinho.</h3>';
        echo '<a href="login.html" class="btn btn-light" style="background-color: #e3cbbc; color: #001d2f; border-radius: 10px; margin-top: 2%; font-family: \'League Spartan\', sans-serif;">Fazer Login</a>';
        echo '</div>';
    }
    ?>
    </div>
</div>

<!-- Total no Rodapé -->
<footer class="fixed-bottom" style="background-color: #021c2d; color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 20px; padding: 10px; width: 100%; display: flex; justify-content: center; align-items: center;">
    <div style="display: flex; align-items: center; justify-content: center;">
        <div style="margin-right: 20px;">
            SUBTOTAL: <span style="font-weight: bold;">R$ <?php echo isset($total) ? number_format($total, 2, ',', '.') : '0,00'; ?></span>
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
