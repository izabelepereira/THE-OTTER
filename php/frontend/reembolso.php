<?php
// Configurações do banco de dados
$host = 'localhost';
$db = 'theotter';
$user = 'root';
$pass = '';

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar autenticação
if (isset($_COOKIE['token_autenticacao'])) {
    $token = $_COOKIE['token_autenticacao'];
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE token_autenticacao = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($usuario_id);
        $stmt->fetch();

        // Processar o pedido de reembolso se o formulário for enviado
        $msgClass = ''; // Classe CSS para a mensagem
        $msg = ''; // Texto da mensagem

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar se há itens no carrinho do usuário
            $stmt = $conn->prepare("SELECT COUNT(*) FROM carrinho WHERE usuario_id = ?");
            $stmt->bind_param("i", $usuario_id);
            $stmt->execute();
            $stmt->bind_result($itemCount);
            $stmt->fetch();
            $stmt->close();

            if ($itemCount > 0) {
                // Receber o tipo de reembolso selecionado
                $tipo_reembolso = $_POST['tipo_reembolso'];
                $status = 'Negado';

                // Determinar o status do reembolso com base na opção
                if (strpos($tipo_reembolso, 'aviso prévio') !== false) {
                    $status = 'Aprovado';
                    $msgClass = 'msg-aprovado';
                    $msg = "Pedido de reembolso aprovado!";
                } else {
                    $msgClass = 'msg-negado';
                    $msg = "Pedido de reembolso negado.";
                }

                // Inserir o pedido de reembolso na tabela
                $stmt = $conn->prepare("INSERT INTO pedidos_reembolso (usuario_id, tipo_reembolso, status) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $usuario_id, $tipo_reembolso, $status);
                $stmt->execute();
                $stmt->close();
            } else {
                $msgClass = 'msg-negado';
                $msg = "Você não possui itens no carrinho para solicitar reembolso.";
            }
        }
    } else {
        // Caso o usuário não seja autenticado, redireciona para a página de login com o alert
        echo "<script>
            alert('Você precisa estar logado para solicitar um reembolso.');
            window.location.href = '../html/login.html';
        </script>";
        exit();
    }
} else {
    // Caso o token não seja encontrado, redireciona para a página de login com o alert
    echo "<script>
        alert('Token de autenticação não encontrado. Faça login.');
        window.location.href = ../html/login.html
;
    </script>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">

   
    <link rel="stylesheet" href="../css/reembolso.css">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">

    <title>Pedido de Reembolso</title>
</head>
<body>
<nav class="navbar fixed-top navbar-dark" style="background-color: #021c2d;">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Ícone de voltar que aparece em todas as resoluções -->
        <a href="javascript:history.back();" class="navbar-brand d-none d-md-block" style="color: #e3cbbc; margin-left: 20%;">
            <i class="fas fa-arrow-left" style="font-size: 1rem;"></i>
        </a>

        <!-- Ícone de voltar que aparece apenas em colapso (telinhas menores) -->
        <a href="javascript:history.back();" class="navbar-brand d-md-none" style="color: #e3cbbc; margin-left: 10%;">
            <i class="fas fa-arrow-left" style="font-size: 1rem;"></i> <!-- Tamanho do ícone maior para colapso -->
        </a>

        <!-- Título centralizado -->
        <span class="navbar-brand mx-auto" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-size: 0.8em; margin-top: 1%;">
           Pedidos de Reembolso
        </span>

        <!-- Ícone de fechar que aparece em todas as resoluções -->
        <a href="javascript:history.back();" class="navbar-brand d-none d-md-block" style="color: #e3cbbc; margin-right: 20%;">
            <i class="fas fa-times" style="font-size: 1rem;"></i>
        </a>

        <!-- Ícone de fechar que aparece apenas em colapso (telinhas menores) -->
        <a href="javascript:history.back();" class="navbar-brand d-md-none" style="color: #e3cbbc; margin-right: 10%;">
            <i class="fas fa-times" style="font-size: 1rem;"></i> <!-- Tamanho do ícone maior para colapso -->
        </a>
    </div>
</nav>



    
    <h2>Solicitar Reembolso</h2>
    <form method="POST" action="" id="formReembolso">
        
        <label for="tipo_reembolso">Escolha o tipo de reembolso:</label>
        <select name="tipo_reembolso" id="tipo_reembolso" required>
            <option value="">Selecione...</option>
            <option value="Reembolso do Ingresso e produtos do Snack Bar, aviso prévio">Reembolso do Ingresso e produtos do Snack Bar, aviso prévio</option>
            <option value="Reembolso do Ingresso, aviso prévio">Reembolso do Ingresso, aviso prévio</option>
            <option value="Qualquer reembolso mas sem pedido com antecedência">Reembolso sem Solicitação Antecipada</option>
        </select>
        
        <div>
            <label for="termos">
                <input type="checkbox" name="termos" id="termos" required>
                Eu concordo com a <a href="#" style="color:#e3ccbc; font-weight: bold;">Politica de Reembolso</a>
            </label>
        </div>

        <div>
            <h3> Politica de Reembolso </h3>
            <p>Política de Reembolso

            De acordo com o Código de Defesa do Consumidor (Lei nº 8.078/1990), o cliente tem até 60 dias corridos, a partir da data de compra, para solicitar o reembolso de ingressos ou produtos adquiridos. O pedido deve ser formalizado dentro desse prazo, com o cliente comparecendo ao cinema pessoalmente, apresentando o CPF e a comprovação de compra. Caso o pedido seja negado, as condições do cinema serão aplicadas, e o cliente será informado sobre as razões da negativa. Após o prazo de 60 dias ou em casos que não atendam às condições de reembolso, a solicitação será rejeitada, e o cliente estará sujeito às normas da empresa.</p>
        </div>

        <label for="descricao">Descrição do pedido (não é obrigatório):</label>
        <textarea name="descricao" id="descricao" rows="4" maxlength="150" placeholder="Analisaremos seu problema."></textarea>

        <!-- Exibir a mensagem de reembolso acima do botão -->
        <?php if ($msg): ?>
            <div class="<?= $msgClass ?>"><?= $msg ?></div>
        <?php endif; ?>

        <footer class="fixed-bottom footer">
    <form class="form-inline justify-content-center">
        <!-- Alterando para "submit" e mantendo a função do modal -->
        <button type="button" class="btn btn-cadastrar" onclick="mostrarModal()">Solicitar Reembolso</button>
    </form>
</footer>
    </form>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h3>Aviso Importante</h3>
            <p>Para o cinema processar seu reembolso, é necessário que você compareça presencialmente ao cinema dentro do prazo de 60 dias com o número do seu CPF. Caso o seu pedido seja negado, será necessário estar ciente das condições do cinema para tal decisão.</p>
            <button id="confirmar" onclick="enviarFormulario()">OK</button>
        </div>
    </div>

    <script>
        // Função para mostrar o modal
        function mostrarModal() {
            var checkbox = document.getElementById("termos");
            if (!checkbox.checked) {
                alert("Você deve concordar com os termos e condições para solicitar o reembolso.");
                return;
            }
            document.getElementById("myModal").style.display = "block";
        }

        // Função para fechar o modal
        function fecharModal() {
            document.getElementById("myModal").style.display = "none";
        }

        // Função para enviar o formulário
        function enviarFormulario() {
            document.getElementById("formReembolso").submit();
        }
    </script>
</body>
</html>