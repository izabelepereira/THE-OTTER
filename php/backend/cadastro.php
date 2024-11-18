<?php
session_start();  // Inicia a sessão para usar variáveis de sessão

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../backend/conexao.php');
// Verifica se o método é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);
    // Coleta os dados do formulário
    $nomeCompleto = trim($_POST['nome']);
    $genero = $_POST['genero'] ?? null;
    $apelido = $_POST['apelido'] ?? null;
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']); // Remove caracteres não numéricos
    $dataNascimento = $_POST['dataNascimento'] ?? null;
    $usarMesmoCPF = isset($_POST['usarMesmoCPF']) ? 1 : 0;
    $email = trim($_POST['email']);
    $telefone = preg_replace('/[^0-9]/', '', $_POST['telefone']); // Remove caracteres não numéricos
    $senha = $_POST['senha'];
    $senhaconfirm = $_POST['senhaconfirm'] ?? '';

    // Validação dos campos
    $errors = [];
    if (empty($nomeCompleto)) $errors[] = "O nome completo é obrigatório.";
    if (empty($cpf)) $errors[] = "O CPF é obrigatório.";
    if (empty($dataNascimento)) $errors[] = "A data de nascimento é obrigatória.";
    if (empty($email)) $errors[] = "O e-mail é obrigatório.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Formato de e-mail inválido.";
    if (empty($telefone)) $errors[] = "O telefone é obrigatório.";
    if (empty($senha) || $senha != $senhaconfirm) $errors[] = "As senhas não coincidem.";

    // Se houver erros, armazena na sessão e redireciona
    if (!empty($errors)) {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = implode('<br>', $errors);
        header("Location: ../frontend/cadastro.php");
        exit;
    }

    // Verificar se o CPF ou e-mail já existe
    $stmt = $conn->prepare("SELECT cpf, email FROM usuarios WHERE cpf = ? OR email = ?");
    $stmt->bind_param("ss", $cpf, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['cpf'] === $cpf) $errors[] = "Este CPF já está cadastrado.";
            if ($row['email'] === $email) $errors[] = "Este e-mail já está cadastrado.";
        }
    }

    // Se houver erros, armazena na sessão e redireciona
    if (!empty($errors)) {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = implode('<br>', $errors);
        header("Location: ../frontend/cadastro.php");
        exit;
    }

    // Caso não haja erros, inserir os dados no banco
    $stmt = $conn->prepare("INSERT INTO usuarios (nome_completo, genero, apelido, cpf, data_nascimento, usar_mesmo_cpf, email, telefone, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);
    $stmt->bind_param("sssssssss", $nomeCompleto, $genero, $apelido, $cpf, $dataNascimento, $usarMesmoCPF, $email, $telefone, $hashedSenha);

    if ($stmt->execute()) {
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Cadastro realizado com sucesso!';
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Erro ao realizar o cadastro.';
    }

    // Redireciona para a página de cadastro
    header("Location: ../frontend/cadastro.php");
    exit;
}
?>
