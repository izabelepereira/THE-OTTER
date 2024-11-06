<?php
// Arquivo de configuração para o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "theotter";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
