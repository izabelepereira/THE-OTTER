<?php
// update_user.php

// Iniciar sessão e incluir arquivo de conexão ao banco de dados
session_start();
include_once('conexao.php'); // Altere para o seu arquivo de conexão

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $genero = $_POST['genero'];
    $dataNascimento = $_POST['dataNascimento'];
    $cpf = $_POST['cpf'];

    // Aqui você deve fazer a validação e atualização no banco de dados
    $userId = $_SESSION['user_id']; // Presumindo que você armazena o ID do usuário na sessão
    $sql = "UPDATE usuarios SET nome=?, apelido=?, genero=?, data_nascimento=?, cpf=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nome, $apelido, $genero, $dataNascimento, $cpf, $userId);

    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar os dados: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
