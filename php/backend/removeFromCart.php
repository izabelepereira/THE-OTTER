<?php
session_start();
include_once('conexao.php');

// Verifica se o usuário está logado
if (isset($_COOKIE['token_autenticacao'])) {
    $token = $_COOKIE['token_autenticacao'];

    // Verificar token e obter o usuário autenticado
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE token_autenticacao = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($usuario_id);
        $stmt->fetch();
        $stmt->close();

        // Recebe o ID do item do carrinho a ser removido
        $carrinhoId = $_POST['carrinhoId'];

        // Verifica se o item pertence ao usuário
        $sql = "SELECT usuario_id FROM carrinho WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $carrinhoId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($itemUsuarioId);
            $stmt->fetch();

            // Verifica se o item pertence ao usuário
            if ($itemUsuarioId == $usuario_id) {
                // Apaga o item do carrinho
                $sqlDelete = "DELETE FROM carrinho WHERE id = ?";
                $stmtDelete = $conn->prepare($sqlDelete);
                $stmtDelete->bind_param("i", $carrinhoId);
                if ($stmtDelete->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Item removido do carrinho']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao remover item']);
                }
                $stmtDelete->close();
            } else {
                echo json_encode(['success' => false, 'message' => 'Você não pode remover este item']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Item não encontrado']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Sessão expirada']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Sessão expirada']);
}
$conn->close();
?>
