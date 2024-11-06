<?php
// Configurações do banco de dados
$host = 'localhost';
$db = 'theotter';
$user = 'root';
$pass = '';

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter dados do formulário
    $emailOrCpf = $_POST['emailOrCpf'] ?? '';
    $password = $_POST['password'] ?? '';

    // Preparar e executar a consulta
    $stmt = $conn->prepare("
        SELECT id, senha, nome_completo, token_autenticacao 
        FROM usuarios 
        WHERE email = ? OR cpf = ?
    ");
    $stmt->bind_param("ss", $emailOrCpf, $emailOrCpf);
    $stmt->execute();
    $stmt->store_result();

    // Verificar se algum resultado foi retornado
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $nome_completo, $stored_token);
        $stmt->fetch();

        // Verificar a senha
        if (password_verify($password, $hashed_password)) {
            // Gerar um token único
            $token = bin2hex(random_bytes(16)); // Gera um token seguro
            
            // Atualizar o banco de dados com o novo token
            $update_stmt = $conn->prepare("UPDATE usuarios SET token_autenticacao = ? WHERE id = ?");
            $update_stmt->bind_param("si", $token, $id);
            $update_stmt->execute();

            // Salvar o token em um cookie
            setcookie("token_autenticacao", $token, time() + 3600, "/"); // O token vai expirar em 1 hora

            // Redirecionar para a página principal ou painel do usuário
            header("Location: ../frontend/home.php");
            exit();
        } else {
            header("Location: error.php?message=Usuário ou senha inválidos.");
            exit();
        }
    } else {
        header("Location: error.php?message=Usuário ou senha inválidos.");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
