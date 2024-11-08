<?php
session_start();
include('conexao.php');

// Define o cabeçalho da resposta como JSON
header('Content-Type: application/json');

// Desativa a exibição de erros para evitar interferência na resposta JSON
error_reporting(0);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Erro ao conectar ao banco de dados.']);
    exit();
}

// Obter os dados enviados
$data = json_decode(file_get_contents('php://input'), true);
$produto_id = $data['produto_id'];
$quantidadeAlterada = $data['quantidade'];

// Recuperar o ID do usuário (ajuste conforme seu sistema de autenticação)
if (!isset($_COOKIE['token_autenticacao'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit();
}

$token = $_COOKIE['token_autenticacao'];
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE token_autenticacao = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo json_encode(['success' => false, 'message' => 'Token inválido ou expirado.']);
    exit();
}

$stmt->bind_result($usuario_id);
$stmt->fetch();
$stmt->close();

// Verificar a quantidade atual do produto no carrinho
$sql = "SELECT quantidade FROM carrinho WHERE usuario_id = ? AND produto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $usuario_id, $produto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $item = $result->fetch_assoc();
    $novaQuantidade = $item['quantidade'] + $quantidadeAlterada;

    // Evitar quantidade negativa ou zero
    if ($novaQuantidade <= 0) {
        echo json_encode(['success' => false, 'message' => 'Quantidade mínima é 1.']);
        exit();
    }

    // Atualizar a quantidade do produto no carrinho
    $sqlUpdate = "UPDATE carrinho SET quantidade = ? WHERE usuario_id = ? AND produto_id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("iii", $novaQuantidade, $usuario_id, $produto_id);
    if ($stmtUpdate->execute()) {
        echo json_encode(['success' => true, 'message' => 'Quantidade atualizada com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar quantidade.']);
    }
    $stmtUpdate->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Produto não encontrado no carrinho.']);
}

$conn->close();
?>
