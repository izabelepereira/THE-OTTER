<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "theotter";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dados do produto
$nome = 'Produto 1';
$descricao = 'Descrição breve do produto 1';
$imagem = 'beijos.png'; // Caminho para a imagem
$categoria = 'chocolates';

// Prepara e executa a inserção
$stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, imagem, categoria) VALUES (?, ?, ?, ?)");
$stmt->bind_param('ssss', $nome, $descricao, $imagem, $categoria);
$stmt->execute();

echo "Produto inserido com sucesso!";

$stmt->close();
$conn->close();
?>
