<?php
session_start();
include('../backend/conexao.php');

// Verificar se os dados necessários foram enviados
if (!isset($_POST['carrinhoId']) || !isset($_POST['tipo'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos']);
    exit();
}

$carrinhoId = $_POST['carrinhoId'];
$tipo = $_POST['tipo'];  // 'ingresso' ou 'snack'

// Verificar o tipo e definir a consulta SQL
if ($tipo === 'ingresso') {
    $query = "DELETE FROM carrinho WHERE id = ? AND movie_id IS NOT NULL";
} elseif ($tipo === 'snack') {
    $query = "DELETE FROM carrinho WHERE id = ? AND produto_id IS NOT NULL";
} else {
    echo json_encode(['success' => false, 'message' => 'Tipo de item inválido']);
    exit();
}

// Preparar a query
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $carrinhoId);

// Executar a query e retornar o resultado
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao remover o item']);
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>
