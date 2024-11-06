<?php
include_once('conexao.php');

// Recuperar o movieId
$movieId = isset($_GET['movieId']) ? $_GET['movieId'] : null;

if ($movieId) {
    // Selecionar todos os assentos ocupados para o filme especificado
    $sql = "SELECT seats FROM carrinho WHERE movie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $movieId);
    $stmt->execute();
    $stmt->store_result();

    $occupiedSeats = [];
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($seats);
        while ($stmt->fetch()) {
            $occupiedSeats = array_merge($occupiedSeats, explode(',', $seats)); // Adiciona os assentos ao array
        }

        // Remover duplicatas e retornar como JSON
        $occupiedSeats = array_unique($occupiedSeats);
        echo json_encode(['success' => true, 'seats' => $occupiedSeats]);
    } else {
        echo json_encode(['success' => true, 'seats' => []]); // Nenhum assento ocupado
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Filme não especificado']);
}
$conn->close();
?>
