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
        // Consulta para obter os itens do carrinho do usuário autenticado, incluindo produtos e ingressos
        $sqlCarrinho = "SELECT c.id, c.movie_id, c.movie_name, c.price, c.poster_path, c.seats, c.room_number, c.data_adicionado, p.id AS produto_id, p.nome AS produto_nome, p.preco AS produto_preco, p.imagem AS produto_imagem, c.quantidade
                        FROM carrinho c
                        LEFT JOIN produtos p ON c.produto_id = p.id
                        WHERE c.usuario_id = ?";
        $stmtCarrinho = $conn->prepare($sqlCarrinho);
        $stmtCarrinho->bind_param('i', $usuario_id);
        $stmtCarrinho->execute();
        $resultCarrinho = $stmtCarrinho->get_result();

        $total = 0; // Variável para o valor total

        if ($resultCarrinho->num_rows > 0) {
            // Exibe a seção de ingressos
            echo '<div class="col-12" style="margin-bottom: 40px;">';
            echo '<h3 style="color: #e3cbbc;"></h3>'; // Título "Ingressos"
            while ($produto = $resultCarrinho->fetch_assoc()) {
                if ($produto['movie_id'] != NULL) {
                    // Formatar a data de adição
                    $dataAdicionado = new DateTime($produto['data_adicionado']);
                    $dataAdicionadoFormatada = $dataAdicionado->format('d/m/Y');  // Exibe apenas a data
                    
                    echo '<div class="col-md-4 col-sm-6 col-12 mb-4">';
                    echo '<div class="card" style="background-color: #001d2f; border-radius: 15px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); display: flex; flex-direction: row; min-height: 250px;">';
                    echo '<div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; padding-right: 10px;">';
                    echo '<h5 class="card-title" style="color: #e3cbbc; margin: 0; font-family: \'League Spartan\', sans-serif; font-size: 1.3em;">' . htmlspecialchars($produto['movie_name']) . '</h5>';
                    echo '<p class="card-text" style="color: #e3cbbc; margin: 0; font-family: \'League Spartan\', sans-serif; font-weight: bold; font-size: 1.2em;">R$ ' . number_format($produto['price'], 2, ',', '.') . '</p>';
                    echo '<p class="card-text m-0" style="color: #e3cbbc; font-size: 1em;">Assento: ' . htmlspecialchars($produto['seats']) . '</p>';
                    echo '<p class="card-text m-0" style="color: #e3cbbc; font-size: 1em;">Sala: ' . htmlspecialchars($produto['room_number']) . '</p>';
                    echo '<p class="card-text m-0" style="color: #e3cbbc; font-size: 1em;">Exibição: ' . $dataAdicionadoFormatada . '</p>';
                    echo '<button class="btn btn-danger btn-sm mt-2" onclick="removeFromCart(' . $produto['id'] . ')"><i class="fa fa-trash"></i> Remover</button>';
                    echo '</div>'; // Fecha o card-body
                    echo '<img src="' . htmlspecialchars($produto['poster_path']) . '" class="card-img-right" alt="' . htmlspecialchars($produto['movie_name']) . '" style="border-radius: 15px; width: 35%; height: auto; object-fit: cover;">';
                    echo '</div>'; // Fecha o card
                    echo '</div>'; // Fecha a coluna

                    // Calcula o total do carrinho
                    $total += $produto['price'];
                }
            }
            echo '</div>'; // Fecha a div de ingressos

            // Exibe a seção de produtos do snack
            echo '<div class="col-12" style="margin-bottom: 40px;">';
            echo '<h3 style="color: #e3cbbc;"></h3>'; // Título "Produtos do Snack"
            
            // Resetando o ponteiro do resultado para iterar novamente
            $resultCarrinho->data_seek(0);
            $temSnack = false; // Flag para verificar se há snack no carrinho
            while ($produto = $resultCarrinho->fetch_assoc()) {
                if ($produto['produto_id'] != NULL) {
                    $temSnack = true; // Se encontrar produto de snack, marca como verdadeiro
                    echo '<div class="col-md-4 col-sm-6 col-12 mb-4">';
                    echo '<div style="background-color: #001d2f; border-radius: 15px; transition: transform 0.3s; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); display: flex; align-items: center; padding: 5%; margin-top: 10%;">';
                    echo '<img src="' . htmlspecialchars($produto['produto_imagem']) . '" class="card-img-left" alt="' . htmlspecialchars($produto['produto_nome']) . '" style="border-radius: 15px; width: 50%; height: auto; object-fit: cover; margin-right: 3%;">';
                    echo '<div class="card-body" style="flex-grow: 1; display: flex; flex-direction: column;">';
                    echo '<h5 class="card-title" style="color: #e3cbbc; margin: 0; font-family: \'League Spartan\', sans-serif;">' . htmlspecialchars($produto['produto_nome']) . '</h5>';
                    echo '<p class="card-text" style="color: #e3cbbc; margin: 0; font-family: \'League Spartan\', sans-serif; font-weight: bold; font-size: 1.6em; margin-bottom: 40%; ">R$ ' . number_format($produto['produto_preco'], 2, ',', '.') . '</p>';
                    
                    // Div para manter tudo na mesma linha: quantidade + botões + lixeira
                    echo '<div class="d-flex align-items-center mb-2">';
                    echo '<button class="btn btn-secondary btn-sm" onclick="atualizarQuantidade(' . $produto['produto_id'] . ', -1)">-</button>';
                    echo '<p class="card-text m-0 mx-2" style="color: #e3cbbc;">' . $produto['quantidade'] . '</p>';
                    echo '<button class="btn btn-secondary btn-sm" onclick="atualizarQuantidade(' . $produto['produto_id'] . ', 1)">+</button>';
                    echo '<button class="btn btn-danger btn-sm ms-2" onclick="removeFromCart(' . $produto['produto_id'] . ')"><i class="fa fa-trash"></i></button>';
                    echo '</div>'; // Fecha a div para os botões e a lixeira
                    
                    echo '</div></div></div>'; // Fecha card e coluna
            
                    // Calcula o total do carrinho
                    $total += $produto['produto_preco'] * $produto['quantidade'];
                }
            }
            
            

            // Se não houver produtos do snack
            if (!$temSnack) {
                echo '<p class="text-center" style="color: #e3cbbc;">Adicione seus snacks agora!</p>';
                echo '<a href="snack.php" class="btn btn-primary">Ver Snacks</a>';
            }

            echo '</div>'; // Fecha a div de produtos do snack
        } else {
            echo '<p class="text-center" style="color: #e3cbbc;">Seu carrinho está vazio.</p>';
        }
        ?>
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
    if (confirm("Tem certeza que deseja remover este item do carrinho?")) {
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

function atualizarQuantidade(produtoId, quantidadeAlterada) {
    // Criar a requisição AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../backend/atualizar_quantidade.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var resposta = JSON.parse(xhr.responseText);
                if (resposta.success) {
                    alert(resposta.message);
                    // Atualizar a página para refletir a nova quantidade
                    location.reload();
                } else {
                    alert(resposta.message);
                }
            } catch (e) {
                console.error("Erro ao parsear JSON:", xhr.responseText);
                alert("Erro inesperado na resposta do servidor.");
            }
        } else {
            alert("Erro na requisição.");
        }
    };

    // Enviar o ID do produto e a quantidade alterada
    var data = JSON.stringify({ produto_id: produtoId, quantidade: quantidadeAlterada });
    xhr.send(data);
}


</script>

</body>

</html>