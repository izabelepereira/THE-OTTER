<?php
session_start();

if (isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];

    // Verifica se o carrinho existe
    if (isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $key => $item) {
            if ($item['id'] == $produto_id) {
                unset($_SESSION['carrinho'][$key]); // Remove o produto do carrinho
                break; // Sai do loop após remover o produto
            }
        }
    }
}

// Redireciona para o carrinho
header("Location: ver_carrinho.php");
exit();
?>
