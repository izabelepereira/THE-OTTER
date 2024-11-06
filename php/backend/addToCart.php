<?php
session_start();
include_once('conexao.php');

// Verifica se o usuário está logado
if (isset($_COOKIE['token_autenticacao'])) {
    $token = $_COOKIE['token_autenticacao'];

    // Verificar token e obter o usuário autenticado
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE token_autenticacao = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($usuario_id);
        $stmt->fetch();
        $stmt->close();

        // Recebe os dados do filme e assentos
        $movieId = $_POST['movieId'];
        $movieName = $_POST['movieName'];
        $moviePrice = $_POST['moviePrice'];
        $showTime = $_POST['showTime'];
        $roomNumber = $_POST['roomNumber'];
        $seats = $_POST['seats'];
        $posterPath = $_POST['posterPath'];

        // Inserir os dados do filme no carrinho
        $sql = "INSERT INTO carrinho (usuario_id, movie_id, movie_name, price, seats, room_number, poster_path, data_adicionado) 
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisssss", $usuario_id, $movieId, $movieName, $moviePrice, $seats, $roomNumber, $posterPath);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Filme adicionado ao carrinho']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao adicionar ao carrinho']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Sessão expirada']);
}
$conn->close();
?>
