<?php
// Configurações do banco de dados
$host = 'localhost';  // Ajuste conforme o seu ambiente
$db = 'theotter';     // Nome do seu banco de dados
$user = 'root';       // Usuário do banco de dados
$pass = '';           // Senha do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $pass, $db);

// Verificar se o cookie de autenticação está presente
if (isset($_COOKIE['token_autenticacao'])) {
    $token = $_COOKIE['token_autenticacao'];

    // Preparar consulta para verificar o token no banco
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE token_autenticacao = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Token válido, o usuário está autenticado
        $stmt->bind_result($usuario_id);
        $stmt->fetch();
        // O ID do usuário pode ser armazenado em uma sessão, se necessário
        // session_start();
        // $_SESSION['usuario_id'] = $usuario_id;
    } else {
        // Token inválido ou expirado, redirecionar para a página de login
        header("Location: html/login.html");
        exit();
    }
    $stmt->close();
} else {
    // Se o cookie não existir, redireciona para o login
    header("Location: html/login.html");
    exit();
}

$conn->close();
?>
