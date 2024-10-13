<?php

// 1. Configurações da conexão
$servername = "localhost"; // Endereço do servidor MySQL (geralmente 'localhost')
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "theotter"; // Nome do banco de dados

// 2. Estabelece a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error); // Encerra o script e exibe a mensagem de erro
}

// 4. Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 5. Coleta os dados do formulário
    $nomeCompleto = $_POST['nome'];
    $genero = $_POST['genero'];
    $apelido = $_POST['apelido'];
    $cpf = $_POST['cpf'];
    $dataNascimento = $_POST['dataNascimento'];
    $usarMesmoCPF = isset($_POST['usarMesmoCPF']) ? 1 : 0; 
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $senhaconfirm = isset($_POST['senhaconfirm']) ? $_POST['senhaconfirm'] : '';


    // 6. Validação simples (você pode adicionar mais validações aqui)
    if (empty($nomeCompleto) || empty($email) || empty($senha) || $senha != $senhaconfirm) {
        echo "Por favor, preencha todos os campos obrigatórios corretamente.";
    } else {

        // 7. Protege a senha com hash
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // 8. Prepara a consulta SQL para inserir os dados de forma segura
        $stmt = $conn->prepare("INSERT INTO usuarios (nome_completo, genero, apelido, cpf, data_nascimento, usar_mesmo_cpf, email, telefone, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssisss", $nomeCompleto, $genero, $apelido, $cpf, $dataNascimento, $usarMesmoCPF, $email, $telefone, $senhaHash);

        // 9. Executa a consulta
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        // 10. Fecha a consulta preparada
        $stmt->close();
    }
}

// 11. Fecha a conexão com o banco de dados
$conn->close();
?>