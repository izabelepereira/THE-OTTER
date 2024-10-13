<?php
session_start(); // Inicia a sessão

// Conectar ao banco de dados
include('conexao.php');

// Verifica se o produto foi adicionado ao carrinho
if (isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];
    $usuario_id = $_SESSION['usuario_id']; // Presumindo que você armazena o ID do usuário na sessão

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
            $nova_quantidade = $item['quantidade'] + 1;

            $sqlUpdate = "UPDATE carrinho SET quantidade = ? WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ii", $nova_quantidade, $item['id']);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        } else {
            // Se o produto não foi encontrado, adiciona-o ao carrinho
            $sqlInsert = "INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $quantidade = 1; // Inicializa a quantidade
            $stmtInsert->bind_param("iii", $usuario_id, $produto_id, $quantidade);
            $stmtInsert->execute();
            $stmtInsert->close();
        }

        echo "Produto adicionado ao carrinho!";
    } else {
        echo "Produto não encontrado.";
    }

    $stmt->close();
}

// Redireciona para a página de visualização do carrinho (opcional)
header("Location: ver_carrinho.php");
exit();

$conn->close();
?>