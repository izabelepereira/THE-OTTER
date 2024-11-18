<?php
include('../backend/conexao.php');

// Verificar se o token de autenticação foi enviado via cookie
if (!isset($_COOKIE['token_autenticacao'])) {
    echo json_encode(["success" => false, "message" => "Você precisa estar logado para realizar o pagamento."]);
    exit();
}

$token = $_COOKIE['token_autenticacao'];

// Obter o ID do usuário associado ao token
$stmt = $conn->prepare("SELECT id, nome_completo FROM usuarios WHERE token_autenticacao = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    echo json_encode(["success" => false, "message" => "Usuário não encontrado."]);
    exit();
}

$stmt->bind_result($usuario_id, $nome_completo);
$stmt->fetch();
$stmt->close();

// Verificar se os dados necessários foram enviados
if (isset($_POST['valor_total']) && isset($_POST['metodo_pagamento'])) {
    // Validar e formatar o valor total
    $valorTotal = (float) str_replace(',', '.', $_POST['valor_total']);
    if ($valorTotal <= 0) {
        echo json_encode(["success" => false, "message" => "Valor total inválido."]);
        exit();
    }

    $metodoPagamento = $_POST['metodo_pagamento'];

    // Inserir os dados do pagamento na tabela 'pagamento'
    try {
        $stmtPagamento = $conn->prepare("INSERT INTO pagamento (usuario_id, total, metodo_pagamento) VALUES (?, ?, ?)");
        $stmtPagamento->bind_param("iss", $usuario_id, $valorTotal, $metodoPagamento);

        if ($stmtPagamento->execute()) {
            // Obter a data atual do pagamento
            $dataPagamento = date("d/m/Y H:i:s");
            
            // Retornar JSON com detalhes do pagamento
            echo json_encode([
                "success" => true,
                "message" => "Pagamento registrado com sucesso!",
                "nome_cliente" => $nome_completo,
                "valor_total" => number_format($valorTotal, 2, ',', '.'), // Formatar o valor com 2 casas decimais
                "data_pagamento" => $dataPagamento
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao registrar pagamento. Tente novamente."]);
        }
        $stmtPagamento->close();
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Erro ao processar pagamento: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Dados de pagamento incompletos. Verifique e tente novamente."]);
}
?>
