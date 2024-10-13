<?php
session_start();
include 'conexao.php'; // Conexão com o banco de dados

if (isset($_SESSION['user_id'])) {
    $usuario_id = $_SESSION['user_id'];
    $produto_id = $_POST['produto_id']; // ID do produto a ser adicionado
    $quantidade = $_POST['quantidade']; // Quantidade do produto

    // Verifica se o produto já está no carrinho
    $stmt = $conn->prepare("SELECT * FROM carrinho WHERE usuario_id = ? AND produto_id = ?");
    $stmt->bind_param("ii", $usuario_id, $produto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se já estiver, atualiza a quantidade
        $stmt = $conn->prepare("UPDATE carrinho SET quantidade = quantidade + ? WHERE usuario_id = ? AND produto_id = ?");
        $stmt->bind_param("iii", $quantidade, $usuario_id, $produto_id);
    } else {
        // Se não estiver, insere um novo item no carrinho
        $stmt = $conn->prepare("INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $usuario_id, $produto_id, $quantidade);
    }

    $stmt->execute();
    echo "Produto adicionado ao carrinho com sucesso!";
} else {
    echo "Você precisa estar logado para adicionar produtos ao carrinho.";
}
?>
