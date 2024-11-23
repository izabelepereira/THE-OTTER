<?php
session_start();
include('conexao.php'); // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $apelido = $_POST['apelido'];
    $cpf = $_POST['cpf'];
    $dataNascimento = $_POST['dataNascimento'];
    $usarMesmoCPF = isset($_POST['usarMesmoCPF']) ? 1 : 0;
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $senhaConfirm = $_POST['senhaconfirm'];

    // Verificação da senha
    if ($senha !== $senhaConfirm) {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'As senhas não coincidem!';
        header('Location: ../frontend/cadastro_page.php'); // Redireciona para a página de cadastro
        exit();
    }

    // Hash da senha antes de armazenar no banco
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Preparar a query para inserir os dados no banco
    $sql = "INSERT INTO usuarios (nome_completo, genero, apelido, cpf, data_nascimento, usar_mesmo_cpf, email, telefone, senha)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssss", $nome, $genero, $apelido, $cpf, $dataNascimento, $usarMesmoCPF, $email, $telefone, $senhaHash);

        // Verifique se a execução da query foi bem-sucedida
        if ($stmt->execute()) {
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Cadastro realizado com sucesso!';
            header('Location: ../frontend/login_page.php'); // Redireciona para a página de login
        } else {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Erro ao cadastrar no banco de dados!';
            header('Location: ../frontend/cadastro_page.php'); // Redireciona para a página de cadastro
        }

        $stmt->close();
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Erro na preparação da query!';
        header('Location: ../frontend/cadastro_page.php'); // Redireciona para a página de cadastro
    }

    $conn->close();
}
?>
