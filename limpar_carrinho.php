<?php
session_start(); // Inicia a sessão

// Limpar o carrinho
unset($_SESSION['carrinho']);

// Redireciona para a página do carrinho
header("Location: ver_carrinho.php");
exit();
?>
