<?php
session_start();
include('../backend/conexao.php');

if (!isset($_COOKIE['token_autenticacao'])) {
    header('Location: ../frontend/login_page.php');
    exit();
}

$token = $_COOKIE['token_autenticacao'];
$stmt = $conn->prepare("SELECT id, nome_completo FROM usuarios WHERE token_autenticacao = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    header('Location: ../frontend/login_page.php');
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
<div class="container-principal" style="flex-grow: 1;">
    <div class="container" style="margin-top: 80px;">
        <h2 class="text-center" style="color: #e3cbbc;"></h2>
        <div class="row">
            <?php
            $sqlCarrinho = "SELECT c.id, c.movie_id, c.movie_name, c.sessionTime, c.room_number, c.seats, c.price, c.poster_path, c.data_adicionado, c.sessionTime, p.id AS produto_id, p.nome AS produto_nome, p.preco AS produto_preco, p.imagem AS produto_imagem, c.quantidade
                            FROM carrinho c
                            LEFT JOIN produtos p ON c.produto_id = p.id
                            WHERE c.usuario_id = ?";
            $stmtCarrinho = $conn->prepare($sqlCarrinho);
            $stmtCarrinho->bind_param('i', $usuario_id);
            $stmtCarrinho->execute();
            $resultCarrinho = $stmtCarrinho->get_result();

            $total = 0;

            if ($resultCarrinho->num_rows > 0) {
                echo '<div class="col-12 carrinho-section">';
                echo '<h3 style="color: #e3cbbc;">Ingressos</h3>';
                while ($produto = $resultCarrinho->fetch_assoc()) {
                    if ($produto['movie_id'] != NULL) {
                        $dataAdicionado = new DateTime($produto['data_adicionado']);
                        $dataAdicionadoFormatada = $dataAdicionado->format('d/m/Y');
                        
                        echo '<div class="col-md-4 col-sm-6 col-12 item-carrinho">';
                        echo '<div class="card">';
                        echo '<div class="card-body" style="flex-grow: 1; padding-right: 10px;">';
                        echo '<h5 class="card-title" style="color: #e3cbbc; font-size: 1.3em;">' . htmlspecialchars($produto['movie_name']) . '</h5>';
                        echo '<p class="card-text" style="color: #e3cbbc; font-weight: bold; font-size: 1.5em;">R$ ' . number_format($produto['price'], 2, ',', '.') . '</p>';
                        echo '<p class="card-text"><strong>Assento:</strong> ' . htmlspecialchars($produto['seats']) . '</p>';
                        echo '<p class="card-text"><strong>Sala: </strong> ' . htmlspecialchars($produto['room_number']) . '</p>';
                        $sessionTime = htmlspecialchars($produto['sessionTime']); // Garantir segurança contra XSS
                        echo '<p class="card-text"><strong> Horário: </strong>' . htmlspecialchars($produto['sessionTime'])  . '</p>';
                        echo '<p class="card-text"><strong>Exibição:</strong> ' . $dataAdicionadoFormatada . '</p>';
                        echo "<button class='btn btn-danger btn-sm mt-2' onclick=\"removeFromCart(" . $produto['id'] . ", 'ingresso')\"><i class='fa fa-trash'></i> </button>";
                        echo '</div>';
                        echo '<img src="' . htmlspecialchars($produto['poster_path']) . '" class="card-img-right" alt="' . htmlspecialchars($produto['movie_name']) . '">';
                        echo '</div>';
                        echo '</div>';
                        

                        $total += $produto['price'];
                    }
                }
                echo '</div>';

            
                echo '<div class="section-divider"></div>';
                
                echo '<div class="col-12 carrinho-section">';
                echo '<h3 style="color: #e3cbbc;">Produtos do Snack</h3>';
                
                $resultCarrinho->data_seek(0);
                $temSnack = false;
                while ($produto = $resultCarrinho->fetch_assoc()) {
                    if ($produto['produto_id'] != NULL) {
                        $temSnack = true;
                        echo '<div class="col-md-4 col-sm-6 col-12 item-carrinho">';
                        echo '<div class="card">';
                        echo '<img src="' . htmlspecialchars($produto['produto_imagem']) . '" class="card-img-left" alt="' . htmlspecialchars($produto['produto_nome']) . '">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title" style="color: #e3cbbc; margin-bottom: 10%;">' . htmlspecialchars($produto['produto_nome']) . '</h5>';
                        echo '<p class="card-text" style="color: #e3cbbc; font-weight: bold; font-size: 1.7em; margin-bottom: 25%;">R$ ' . number_format($produto['produto_preco'], 2, ',', '.') . '</p>';
                        
                        echo '<div class="d-flex align-items-center mb-2 diva" style="margin-left: 35%;">';
                        echo '<button class="btn btn-secondary btn-sm" onclick="atualizarQuantidade(' . $produto['produto_id'] . ', -1)">-</button>';
                        echo '<p class="card-text m-0 mx-2" style="color: #e3cbbc; font-size: 1.2em; font-weight: bold;">' . $produto['quantidade'] . '</p>';
                        echo '<button class="btn btn-secondary btn-sm" onclick="atualizarQuantidade(' . $produto['produto_id'] . ', 1)">+</button>';
                        echo '<button class="btn btn-danger btn-sm ms-2" onclick="removeFromCart(' . $produto['produto_id'] . ', \'snack\')"><i class="fa fa-trash"></i></button>';
                        echo '</div>';
                        
                        echo '</div></div></div>';
                
                        $total += $produto['produto_preco'] * $produto['quantidade'];
                    }
                }

                if (!$temSnack) {
                    echo '<p class="text-center" style="color: #e3cbbc;">Adicione seus snacks agora!</p>';
                    echo '<a href="snack.php" class="btn btn-primary">Ver Snacks</a>';
                }

                echo '</div>';
            } else {
                echo '<p class="text-center" style="color: #e3cbbc;">Seu carrinho está vazio.</p>';
            }
            ?>
        </div>
    </div>
</div>

<footer class="fixed-bottom" style="background-color: #021c2d; color: #e3cbbc; font-weight: bold; font-size: 20px; padding: 10px; display: flex; justify-content: center; align-items: center;">
    <div style="display: flex; align-items: center; justify-content: center;">
        <div style="margin-right: 20px;">
            SUBTOTAL: <span style="font-weight: bold;">R$ <?php echo number_format($total, 2, ',', '.'); ?></span>
        </div>
        <form class="form-inline" action="pagamento.php" method="post">
    <input type="hidden" name="total" value="<?php echo number_format($total, 2, ',', '.'); ?>">
    <button type="submit" class="btn" style="background-color: #021c2d; color: #1a4a67; border: none; padding: 15px 30px; font-size: 20px; font-weight: bold;">
        CONCLUIR COMPRA
    </button>
</form>

    </div>
</footer>

<script>
// JavaScript para manipulação de carrinho (remover e atualizar quantidade)
function removeFromCart(carrinhoId, tipo) {
    if (confirm("Tem certeza que deseja remover este item do carrinho?")) {
        fetch('../backend/removeFromCart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'carrinhoId': carrinhoId,
                'tipo': tipo // Passa o tipo para distinguir entre 'ingresso' ou 'snack'
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
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../backend/atualizar_quantidade.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                var resposta = JSON.parse(xhr.responseText);
                if (resposta.success) {
                    alert(resposta.message);
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

    var data = JSON.stringify({ produto_id: produtoId, quantidade: quantidadeAlterada });
    xhr.send(data);
}
</script>
</body>
</html>
