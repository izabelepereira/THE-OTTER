<?php
session_start();
include_once('conexao.php');

// Ativar exibição de erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verifica se o usuário está logado
if (isset($_COOKIE['token_autenticacao'])) {
    $token = $_COOKIE['token_autenticacao'];

    // Verificar token e obter o usuário autenticado
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE token_autenticacao = ?");
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conn->error); // Exibe erro na preparação
    }

    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($usuario_id);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

// Verificar se os dados foram recebidos corretamente via POST
if (!isset($_POST['movieId']) || !isset($_POST['movieName']) || !isset($_POST['sessionTime']) || !isset($_POST['roomNumber']) || !isset($_POST['seats']) || !isset($_POST['moviePrice']) || !isset($_POST['posterPath'])) {
    // Verificar os dados enviados no POST
    error_log("Dados recebidos: " . print_r($_POST, true));  // Depurar os dados recebidos no POST
    echo json_encode(['success' => false, 'message' => 'Dados faltando']);
    exit;
}

// Recebe os dados do filme e assentos
$movieId = $_POST['movieId'];
$movieName = $_POST['movieName'];
$sessionTime = $_POST['sessionTime'];
$roomNumber = $_POST['roomNumber'];
$seats = $_POST['seats'];
$moviePrice = $_POST['moviePrice'];
$posterPath = $_POST['posterPath'];

// Exibir dados recebidos para depuração
error_log("Dados recebidos: movieId=$movieId, movieName=$movieName, moviePrice=$moviePrice, sessionTime=$sessionTime, roomNumber=$roomNumber, seats=$seats, posterPath=$posterPath");

// Preparar e executar a consulta SQL para inserir no carrinho
$sql = "INSERT INTO carrinho (usuario_id, movie_id, movie_name, sessionTime, room_number, seats, price, poster_path, data_adicionado, quantidade, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 1, 'ativo')";  // Adicionando valores padrão para 'quantidade' e 'status'

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    error_log("Erro na preparação da consulta SQL: " . $conn->error);
    echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta', 'errorDetails' => $conn->error]);
    exit;
}

// Vincula os parâmetros
if (!$stmt->bind_param("iissssss", $usuario_id, $movieId, $movieName, $sessionTime, $roomNumber, $seats, $moviePrice, $posterPath)) {
    error_log("Erro ao vincular parâmetros: " . $stmt->error);
    echo json_encode(['success' => false, 'message' => 'Erro ao vincular parâmetros', 'errorDetails' => $stmt->error]);
    exit;
}

// Executa a consulta e verifica se deu certo
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Filme adicionado ao carrinho']);
} else {
    error_log("Erro ao executar consulta SQL: " . $stmt->error);
    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar ao carrinho', 'errorDetails' => $stmt->error]);
}

$stmt->close();
?>
