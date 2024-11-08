<?php 
// Iniciar a sessão
session_start();

// Conectar ao banco de dados
include('conexao.php');

// Verifique se a conexão foi bem-sucedida
if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Erro ao conectar ao banco de dados.']);
    exit();
}

// Verificar se o token está presente
if (!isset($_COOKIE['token_autenticacao'])) {
    echo json_encode(['success' => false, 'message' => 'Token não encontrado. Por favor, faça login novamente.']);
    exit();
}

// Recuperar o token do cookie
$token = $_COOKIE['token_autenticacao'];

// Verificar se o token é válido e obter o usuario_id
$stmt = $conn->prepare("SELECT id, nome_completo FROM usuarios WHERE token_autenticacao = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo json_encode(['success' => false, 'message' => 'Token inválido ou expirado. Faça login para continuar.']);
    exit();
}

$stmt->bind_result($usuario_id, $nome_completo);
$stmt->fetch();
$stmt->close();

// Verificar se o produto ou ingresso foi adicionado ao carrinho ou se a quantidade precisa ser atualizada
if (isset($_POST['produto_id']) || isset($_POST['movie_id'])) {
    
    // Adicionar ou atualizar produto do snack bar no carrinho
    if (isset($_POST['produto_id'])) {
        $produto_id = $_POST['produto_id'];
        $quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : 1;

        // Verificar se o produto existe
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $produto_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $produto = $result->fetch_assoc();

            // Verificar se o produto já está no carrinho
            $sqlCheck = "SELECT * FROM carrinho WHERE usuario_id = ? AND produto_id = ?";
            $stmtCheck = $conn->prepare($sqlCheck);
            $stmtCheck->bind_param("ii", $usuario_id, $produto_id);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();

            if ($resultCheck->num_rows > 0) {
                $item = $resultCheck->fetch_assoc();
                $nova_quantidade = $item['quantidade'] + $quantidade;

                // Atualizar a quantidade do produto no carrinho
                $sqlUpdate = "UPDATE carrinho SET quantidade = ? WHERE id = ?";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ii", $nova_quantidade, $item['id']);
                $stmtUpdate->execute();
                $stmtUpdate->close();
                echo json_encode(['success' => true, 'message' => 'Quantidade de produto atualizada no carrinho!']);
                exit();
            } else {
                // Adicionar o produto ao carrinho
                $sqlInsert = "INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("iii", $usuario_id, $produto_id, $quantidade);
                $stmtInsert->execute();
                $stmtInsert->close();
                echo json_encode(['success' => true, 'message' => 'Produto do snack bar adicionado ao carrinho!']);
                exit();
            }
            $stmtCheck->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Produto não encontrado.']);
            exit();
        }
        $stmt->close();
    }

    // Adicionar ingresso ao carrinho
    if (isset($_POST['movie_id'])) {
        $movie_id = $_POST['movie_id'];
        $ticket_price = $_POST['ticket_price'];
        $show_time = $_POST['show_time'];
        $room = $_POST['room'];
        $seat = $_POST['seat'];

        // Verificar se o assento já está no carrinho
        $sqlCheck = "SELECT * FROM carrinho WHERE usuario_id = ? AND movie_id = ? AND seat = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("iis", $usuario_id, $movie_id, $seat);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Este assento já foi reservado para este filme.']);
            exit();
        } else {
            // Adicionar o ingresso ao carrinho
            $sqlInsert = "INSERT INTO carrinho (usuario_id, movie_id, produto_id, ticket_price, show_time, room, seat, poster_path) 
                          VALUES (?, ?, NULL, ?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("iisisss", $usuario_id, $movie_id, $ticket_price, $show_time, $room, $seat, $_POST['poster_path']);
            $stmtInsert->execute();
            $stmtInsert->close();
            echo json_encode(['success' => true, 'message' => 'Ingresso adicionado ao carrinho!']);
            exit();
        }
        $stmtCheck->close();
    }
}

// Atualizar a quantidade de um produto específico no carrinho
if (isset($_POST['produto_id']) && isset($_POST['nova_quantidade'])) {
    $produto_id = $_POST['produto_id'];
    $nova_quantidade = (int) $_POST['nova_quantidade'];

    if ($nova_quantidade <= 0) {
        echo json_encode(['success' => false, 'message' => 'Quantidade inválida.']);
        exit();
    }

    $sqlUpdate = "UPDATE carrinho SET quantidade = ? WHERE usuario_id = ? AND produto_id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("iii", $nova_quantidade, $usuario_id, $produto_id);

    if ($stmtUpdate->execute()) {
        echo json_encode(['success' => true, 'message' => 'Quantidade atualizada com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar quantidade.']);
    }
    $stmtUpdate->close();
    exit();
}

echo json_encode(['success' => false, 'message' => 'Dados do produto ou ingresso não fornecidos.']);
$conn->close();
?>
