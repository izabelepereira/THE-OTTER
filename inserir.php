<?php
// Configurações de conexão
$host = "localhost"; // ou o nome do seu servidor
$user = "root"; // seu nome de usuário
$password = ""; // sua senha
$dbname = "theotter"; // seu banco de dados

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Array de produtos a serem inseridos (sem descrição)
$produtos = [
    ['Chocolate Amargo', 6.00, 'images/chocolate_amargo.png', 'guloseimas'],
    ['Bala de Menta', 1.50, 'images/bala_de_menta.png', 'guloseimas'],
    ['Batata Frita', 4.50, 'images/batata_frita.png', 'snacks'],
    ['Água Mineral', 2.50, 'images/agua_mineral.png', 'bebidas'],
    ['Combo Kids', 20.00, 'images/combo_kids.png', 'combos'],
];

// Inserir produtos no banco de dados
foreach ($produtos as $produto) {
    $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, imagem, categoria) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $produto[0], $produto[1], $produto[2], $produto[3]); // Corrigido para "sdss"
    
    if ($stmt->execute()) {
        echo "Produto inserido: " . $produto[0] . "<br>";
    } else {
        echo "Erro ao inserir produto: " . $stmt->error . "<br>";
    }
}

// Fechar a declaração e a conexão
$stmt->close();
$conn->close();
?>
