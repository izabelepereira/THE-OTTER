<?php
// Incluir o arquivo de conexão
include 'conexao.php';

// Exemplo de uma consulta
$sql = "SELECT * FROM sua_tabela";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Saída de dados de cada linha
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Nome: " . $row["nome"]. "<br>";
    }
} else {
    echo "0 resultados";
}

// Fechar a conexão
$conn->close();
?>
