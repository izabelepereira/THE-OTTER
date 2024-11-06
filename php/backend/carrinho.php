<?php
// Iniciar a sessão
session_start();

// Conectar ao banco de dados
include('conexao.php');

// Verificar se o token está presente
if (!isset($_COOKIE['token_autenticacao'])) {
    // Se não tiver token, redireciona para o login
    echo "Token não encontrado. Por favor, faça login novamente.";
    exit();
}

// Recuperar o token do cookie
$token = $_COOKIE['token_autenticacao'];

// Verificar se o token é válido e obter o usuario_id
$stmt = $conn->prepare("SELECT id, nome_completo FROM usuarios WHERE token_autenticacao = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    // Token inválido ou expirado
    echo "Token inválido ou expirado. Faça login para continuar.";
    exit();
}

$stmt->bind_result($usuario_id, $nome_completo);
$stmt->fetch();
$stmt->close();

// Verifica se o produto foi adicionado ao carrinho
if (isset($_POST['produto_id']) || isset($_POST['movie_id'])) {
    
    // Adicionar produto ao carrinho
    if (isset($_POST['produto_id'])) {
        $produto_id = $_POST['produto_id'];
        $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : 1; // Quantidade do produto (1 por padrão)
        
        // Consulta o produto no banco de dados
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $produto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $produto = $result->fetch_assoc();

            // Verifica se o produto já está no carrinho
            $sqlCheck = "SELECT * FROM carrinho WHERE usuario_id = ? AND produto_id = ?";
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bind_param("ii", $usuario_id, $produto_id);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();

            if ($resultCheck->num_rows > 0) {
                // Produto já está no carrinho, apenas aumenta a quantidade
                $item = $resultCheck->fetch_assoc();
                $nova_quantidade = $item['quantidade'] + $quantidade;

                $sqlUpdate = "UPDATE carrinho SET quantidade = ? WHERE id = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ii", $nova_quantidade, $item['id']);
                $stmtUpdate->execute();
                $stmtUpdate->close();
                echo "Produto quantidade atualizada no carrinho!";
            } else {
                // Se o produto não foi encontrado no carrinho, adiciona-o ao carrinho
                $sqlInsert = "INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("iii", $usuario_id, $produto_id, $quantidade);
                $stmtInsert->execute();
                $stmtInsert->close();
                echo "Produto adicionado ao carrinho!";
            }

            $stmtCheck->close();
        } else {
            echo "Produto não encontrado.";
        }

        $stmt->close();
    }

    // Adicionar ingresso ao carrinho
    if (isset($_POST['movie_id'])) {
        $movie_id = $_POST['movie_id'];
        $movie_name = $_POST['movie_name'];
        $ticket_price = $_POST['ticket_price'];
        $show_time = $_POST['show_time'];
        $room = $_POST['room'];
        $seat = $_POST['seat'];

        // Verifica se o ingresso já está no carrinho (não permite duplicação de assentos)
        $sqlCheck = "SELECT * FROM carrinho WHERE usuario_id = ? AND movie_id = ? AND seat = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("iis", $usuario_id, $movie_id, $seat);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            // Ingresso já está no carrinho, não permite mais de um ingresso por assento
            echo "Este assento já foi reservado para este filme.";
        } else {
            // Adiciona o ingresso ao carrinho
            $sqlInsert = "INSERT INTO carrinho (usuario_id, movie_id, produto_id, ticket_price, show_time, room, seat, poster_path) 
                          VALUES (?, ?, NULL, ?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("iisisss", $usuario_id, $movie_id, $ticket_price, $show_time, $room, $seat, $_POST['poster_path']);
            $stmtInsert->execute();
            $stmtInsert->close();
            echo "Ingresso adicionado ao carrinho!";
        }

        $stmtCheck->close();
    }

} else {
    echo "Dados do produto ou ingresso não fornecidos.";
}

// Redireciona para a página de visualização do carrinho (opcional)
header("Location: ../frontend/ver_carrinho.php");
exit();

$conn->close();
?>
