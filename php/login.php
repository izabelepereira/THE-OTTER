<?php
session_start();

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
        SELECT senha, nome_completo 
        FROM usuarios 
        WHERE email = ? OR cpf = ?
    ");
    $stmt->bind_param("ss", $emailOrCpf, $emailOrCpf);
    $stmt->execute();
    $stmt->store_result();

    // Verificar se algum resultado foi retornado
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $nome_completo);
        $stmt->fetch();

        // Verificar a senha
        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['emailOrCpf'] = $emailOrCpf;
            $_SESSION['nome_completo'] = $nome_completo; // Armazenar o nome completo na sessão
            header("Location: welcome.php");
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
