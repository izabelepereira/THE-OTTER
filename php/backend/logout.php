<?php
session_start();

// Destruir todas as sessões
session_unset();
session_destroy();

// Limpar cookies de autenticação (se usados)
if (isset($_COOKIE['token_autenticacao'])) {
    setcookie('token_autenticacao', '', time() - 3600, '/');
}

// Redirecionar para a página de login ou inicial
header("Location: ../frontend/login_page.php");
exit();
?>
