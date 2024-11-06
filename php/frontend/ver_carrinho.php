<?php
session_start(); // Inicia a sessão
include('../backend/conexao.php'); // Conexão com o banco de dados

// Verificar se o token está presente e é válido
if (!isset($_COOKIE['token_autenticacao'])) {
    // Redireciona para o login se o token não estiver presente
    header('Location: login.php');
    exit();
}

// Recupera o token do cookie
$token = $_COOKIE['token_autenticacao'];

// Verificar se o token é válido
$stmt = $conn->prepare("SELECT id, nome_completo FROM usuarios WHERE token_autenticacao = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    // Token inválido ou expirado, redireciona para login
    header('Location: login.php');
    exit();
}

$stmt->bind_result($usuario_id, $nome_completo);
$stmt->fetch();
$stmt->close();
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

<div class="container" style="margin-top: 80px;">
    <h2 class="text-center" style="color: #e3cbbc;"></h2>
    <div class="row">
        <?php
       // Consulta para obter os itens do carrinho do usuário autenticado
$sqlCarrinho = "SELECT c.id, c.movie_id, c.movie_name, c.price, c.poster_path, c.seats, c.room_number, c.data_adicionado 
FROM carrinho c
WHERE c.usuario_id = ?";
$stmtCarrinho = $conn->prepare($sqlCarrinho);
$stmtCarrinho->bind_param('i', $usuario_id);
$stmtCarrinho->execute();
$resultCarrinho = $stmtCarrinho->get_result();


        $total = 0; // Variável para o valor total
        if ($resultCarrinho->num_rows > 0) {
            echo '<h3 style="color: #e3cbbc;">Ingressos:</h3>'; // Título "Ingressos"
            while ($produto = $resultCarrinho->fetch_assoc()) {
                // Formatar a data de adição
                $dataAdicionado = new DateTime($produto['data_adicionado']);
                $dataAdicionadoFormatada = $dataAdicionado->format('d/m/Y');  // Exibe apenas a data
            
                echo '<div class="col-md-4 col-sm-6 col-12 mb-4">'; // Ajuste para exibir 3 por linha
                echo '<div class="card" style="background-color: #001d2f; border-radius: 15px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); display: flex; flex-direction: row; min-height: 250px;">';
            
                // Coluna de texto à esquerda
                echo '<div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; padding-right: 10px;">';
                echo '<h5 class="card-title" style="color: #e3cbbc; margin: 0; font-family: \'League Spartan\', sans-serif; font-size: 1.3em;">' . htmlspecialchars($produto['movie_name']) . '</h5>';
                echo '<p class="card-text" style="color: #e3cbbc; margin: 0; font-family: \'League Spartan\', sans-serif; font-weight: bold; font-size: 1.2em;">R$ ' . number_format($produto['price'], 2, ',', '.') . '</p>';
            
                // Exibe os assentos selecionados
                echo '<p class="card-text m-0" style="color: #e3cbbc; font-size: 1em;">Assento: ' . htmlspecialchars($produto['seats']) . '</p>';
            
                // Exibe a sala
                echo '<p class="card-text m-0" style="color: #e3cbbc; font-size: 1em;">Sala: ' . htmlspecialchars($produto['room_number']) . '</p>';
            
                // Exibe a data de adição
                echo '<p class="card-text m-0" style="color: #e3cbbc; font-size: 1em;">Exibição: ' . $dataAdicionadoFormatada . '</p>';
            
                // Ícone de lixeira
                echo '<button class="btn btn-danger btn-sm mt-2" onclick="removeFromCart(' . $produto['id'] . ')"><i class="fa fa-trash"></i> Remover</button>';
            
                echo '</div>'; // Fecha o card-body
                echo '<img src="' . htmlspecialchars($produto['poster_path']) . '" class="card-img-right" alt="' . htmlspecialchars($produto['movie_name']) . '" style="border-radius: 15px; width: 35%; height: auto; object-fit: cover;">';
                echo '</div>'; // Fecha o card
                echo '</div>'; // Fecha a coluna
            
            

                // Calcula o total do carrinho
                $total += $produto['price'];
            }
        } else {
            echo '<p class="text-center" style="color: #e3cbbc;">Seu carrinho está vazio.</p>';
        }
        ?>
    </div>
</div>


    <!-- Exibir informações dos ingressos -->

        <div class="col-12">
            <div class="informacoes-filme">
                <?php
                // Recuperar informações dos ingressos passadas pela URL ou do banco de dados
                $selectedSeats = isset($_GET['seats']) ? $_GET['seats'] : 'Nenhum assento selecionado';
                $movieName = isset($_GET['movieTitle']) ? $_GET['movieTitle'] : 'Filme Desconhecido';
                $ticketPrice = isset($_GET['ticketPrice']) ? $_GET['ticketPrice'] : 0;
                $showTime = isset($_GET['sessionTime']) ? $_GET['sessionTime'] : 'Não definido';
                $room = isset($_GET['room']) ? $_GET['room'] : 'Sala Desconhecida';

            
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Rodapé com total e botão de pagamento -->
<footer class="fixed-bottom" style="background-color: #021c2d; color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 20px; padding: 10px; width: 100%; display: flex; justify-content: center; align-items: center;">
    <div style="display: flex; align-items: center; justify-content: center;">
        <div style="margin-right: 20px;">
            SUBTOTAL: <span style="font-weight: bold;">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
        </div>
        <form class="form-inline" action="pagamento.php" method="post">
            <button type="submit" class="btn"
                style="background-color: #021c2d; color: #1a4a67; border: none; padding: 15px 30px; font-size: 20px; font-weight: bold;">
                CONCLUIR COMPRA
            </button>
        </form>
    </div>
</footer>
<script>
function removeFromCart(carrinhoId) {
    if (confirm("Tem certeza que deseja remover este ingresso do carrinho?")) {
        fetch('../backend/removeFromCart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'carrinhoId': carrinhoId // Passa o ID do item do carrinho
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Atualiza a página do carrinho após a remoção
                window.location.reload();
            } else {
                alert(data.message || 'Erro ao remover do carrinho');
            }
        })
        .catch(error => {
            console.error('Erro ao se comunicar com o servidor. Tente novamente mais tarde.');
        });
    }
}
</script>
</body>

</html>
