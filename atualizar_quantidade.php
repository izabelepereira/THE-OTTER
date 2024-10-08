<?php
session_start();

if (isset($_POST['produto_id']) && isset($_POST['acao'])) {
    $produto_id = $_POST['produto_id'];

    // Verifica se o carrinho existe e se o produto está no carrinho
    if (isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $key => &$item) {
            if ($item['id'] == $produto_id) {
                if ($_POST['acao'] == 'aumentar') {
                    $item['quantidade']++; // Aumenta a quantidade
                } elseif ($_POST['acao'] == 'diminuir') {
                    if ($item['quantidade'] > 1) {
                        $item['quantidade']--; // Diminui a quantidade
                    } else {
                        // Se a quantidade for 1, remove o produto do carrinho
                        unset($_SESSION['carrinho'][$key]);
                    }
                }
                break; // Sai do loop após encontrar o produto
            }
        }

        // Reorganiza o carrinho para remover produtos vazios
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    }
}

// Redireciona para o carrinho
header("Location: ver_carrinho.php");
exit();
?>
