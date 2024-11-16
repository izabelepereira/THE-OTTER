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

    // Validação de e-mail ou CPF
    if (empty($emailOrCpf) || empty($password)) {
        header("Location: ../frontend/login_page.php?message=Preencha todos os campos.");
        exit();
    }

    // Verifica se é um e-mail ou CPF
    if (filter_var($emailOrCpf, FILTER_VALIDATE_EMAIL)) {
        $isEmail = true;

        // Validar o domínio do e-mail (exemplo: "gmail.com")
        $allowedDomain = 'gmail.com'; // Você pode mudar para o domínio desejado
        $emailParts = explode('@', $emailOrCpf);
        if (count($emailParts) == 2 && $emailParts[1] === $allowedDomain) {
            // Preparar e executar a consulta para buscar o e-mail no banco de dados
            $stmt = $conn->prepare("SELECT id, senha, nome_completo, token_autenticacao FROM usuarios WHERE email = ?");
        } else {
            header("Location: ../frontend/login_page.php?message=Email com domínio inválido. Apenas $allowedDomain permitido.");
            exit();
        }

    } elseif (preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $emailOrCpf)) {
        $isEmail = false;
        // Preparar e executar a consulta para buscar o CPF no banco de dados
        $stmt = $conn->prepare("SELECT id, senha, nome_completo, token_autenticacao FROM usuarios WHERE cpf = ?");
    } else {
        header("Location: ../frontend/login_page.php?message=Formato de e-mail ou CPF inválido.");
        exit();
    }
    
    // Bind e execução da consulta
    $stmt->bind_param("s", $emailOrCpf);
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
            header("Location: ../frontend/login_page.php?message=Usuário ou senha inválidos.");
            exit();
        }
    } else {
        header("Location: ../frontend/login_page.php?message=Usuário ou senha inválidos.");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
