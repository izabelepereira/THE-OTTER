<?php
session_start();
include('../backend/conexao.php');

// Verificar se o total foi passado corretamente
if (!isset($_POST['total'])) {
    header('Location: carrinho.php');
    exit();
}
$total = (float) str_replace(',', '.', $_POST['total']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php
$pageTitle = 'Finalizar Compra - Snack Bar';
include_once('../head.php');
?>
<link rel="stylesheet" href="../css/pay.css">
<style>
@font-face {
    font-family: 'Heavitas';
    /* Nome que você deseja usar para a fonte */
    src: url('../../fonts/Heavitas.ttf') format('truetype');
    /* Caminho para a fonte */
    font-weight: normal;
    /* Ajuste o peso se necessário */
    font-style: normal;
    /* Ajuste o estilo se necessário */
  }
</style>

<body style="background-color: #001d2f; color: #e3cbbc; font-family: 'League Spartan', sans-serif;">

<?php
$pageLabel = "Pagamento"; 
include '../navbar1.php';
?>

<div class="container-principal" style="flex-grow: 1;">
    <div class="container" style="display: flex; justify-content: center; align-items: center; height: 80vh;">
        <img id="snackImage" src="../../images/pago.png" alt="Imagem" class="snack-image" style="width: 90%; border-radius: 15px; height: auto;">
    </div>

    <div style="padding-top: -20px;">
        <div class="container">
            <p style= "text-align: left; font-family: 'Heavitas'; font-size: 1.5em; margin-left: 5%; margin-top:-5%;">Subtotal: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
            <p id="pay-message" style="text-align: center; margin-top: 20px;"></p>
                    <div id="feedback-message" style="color: red; margin-top: 20px; text-align: center;"></div> <!-- Div para exibir mensagens -->

                    <div class="row">
                    <div class="col-md-12" style="margin-left: 5%; border: #e3ccbc solid 2px; padding: 2%; border-radius: 15px; width: 90%;">
    <!-- Formas de pagamento -->
    <h2 style="margin: 20px 0; font-size: 1.5em; text-align: left; margin-left: 1%;">Formas de Pagamento</h2>
    
    <!-- Opção de pagamento Cartão de Crédito -->
    <div class="payment-option" id="credit-card" style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s; text-align: left;" onclick="selectPayment('credit-card')">
        <i class="fas fa-credit-card" style="font-size: 24px; margin-right: 10px;"></i>
        <h5 style="display: inline;">Cartão de Crédito</h5>
    </div>
    
    <!-- Opção de pagamento Cartão de Débito -->
    <div class="payment-option" id="debit-card" style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s; text-align: left;" onclick="selectPayment('debit-card')">
        <i class="fas fa-credit-card" style="font-size: 24px; margin-right: 10px;"></i>
        <h5 style="display: inline;">Cartão de Débito</h5>
    </div>
    
    <!-- Opção de pagamento PIX -->
    <div class="payment-option" id="pix" style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s; text-align: left;" onclick="selectPayment('pix')">
        <i class="fas fa-money-bill-wave" style="font-size: 24px; margin-right: 10px;"></i>
        <h5 style="display: inline;">PIX</h5>
    </div>

    <!-- Mensagem de pagamento -->
    <p id="payment-message" style="text-align: left; margin-top: 20px;"></p>                    

    <!-- Formulário de Cartão de Crédito -->
    <div id="credit-card-form" style="display: none;">
        <label for="cardNumber">Número do Cartão</label>
        <input type="text" id="cardNumber" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">
        
        <label for="expiryDate">Data de Validade</label>
        <input type="text" id="expiryDate" class="form-control" placeholder="MM/AA">
        
        <label for="cvv">CVV</label>
        <input type="text" id="cvv" class="form-control" placeholder="CVV">
    </div>
    
    <!-- Canvas do QR Code (invisível inicialmente) -->
    <canvas id="qr-code" style="margin-top: 20px; display: none;"></canvas>
</div>


<!-- Footer fixo -->
<form action="../backend/processar_pagamento.php" method="POST" id="formPagamento">
    <input type="hidden" name="valor_total" value="<?php echo $total; ?>">
    <input type="hidden" name="payment_method" id="payment_method">
    <button type="submit" id="confirm-footer-button" class="btn btn-primary" disabled 
        style="background-color: #001d2f; color: #e3cbbc; padding: 10px 20px; border: none; font-weight: bold; font-size: 18px; 
               position: fixed; bottom: 0; left: 0; width: 100%; text-align: center;">
        CONFIRMAR COMPRA
    </button>
</form>



<!-- Modal de Confirmação de Pagamento -->
<div id="paymentModal" class="modal" style="display: none;">
    <div class="modal-content" style="background-color: #001d2f; color: #e3cbbc; padding: 20px; border-radius: 10px;">
        <span class="close" onclick="closeModal()" style="color: #e3cbbc; font-size: 30px; cursor: pointer;">&times;</span>
        <div style="text-align: center;">
            <i class="fas fa-check-circle" style="font-size: 50px; color: #28a745;"></i>
            <h3 style="margin-top: 20px;">Pagamento Realizado com Sucesso!</h3>
            <p id="modal-message" style="margin-top: 20px; font-size: 18px;">Seu pagamento foi processado com sucesso. Agradecemos pela sua compra!</p>
            <button onclick="window.location.href='confirmacao.php'" 
        style="background-color: #28a745; border: none; color: white; padding: 10px 20px; border-radius: 5px; cursor: not-allowed; font-size: 18px; margin-top: 20px;" 
        disabled>Agradecemos sua preferência!</button>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
<script>
    let selectedPayment = null;
    const qrCodeCanvas = document.getElementById('qr-code');
    const qr = new QRious({
        element: qrCodeCanvas,
        size: 200, 
        value: '',
    });

    function selectPayment(paymentMethod) {
        const paymentOptions = document.querySelectorAll('.payment-option');
        paymentOptions.forEach(option => {
            option.style.borderColor = 'transparent';
        });

        const selectedOption = document.getElementById(paymentMethod);
        selectedOption.style.borderColor = '#e3cbbc';
        selectedPayment = paymentMethod;

        const message = document.getElementById('payment-message');
        if (paymentMethod === 'pix') {
            message.innerText = 'Você escolheu PIX. O código QR será gerado abaixo.';
            const pixQRCodeValue = `00020101021126790014BR.GOV.BCB.PIX0136${parseFloat('<?php echo $total; ?>').toFixed(2).replace('.', '').replace(',', '')}5204000053039865802BR5912Loja Cinema6009SAO PAULO62070503***6304`;
            qr.set({ value: pixQRCodeValue });
            qrCodeCanvas.style.display = 'block';
        } else {
            message.innerText = `Você escolheu ${paymentMethod}. Finalize a compra com o botão abaixo.`;
            qrCodeCanvas.style.display = 'none';
            qr.set({ value: '' });
        }

        if (paymentMethod === 'credit-card' || paymentMethod === 'debit-card') {
            document.getElementById('credit-card-form').style.display = 'block';
        } else {
            document.getElementById('credit-card-form').style.display = 'none';
        }

        document.getElementById('confirm-footer-button').disabled = false;
        document.getElementById('payment_method').value = paymentMethod;
    }

    document.getElementById('formPagamento').addEventListener('submit', function(event) {
    const feedbackMessage = document.getElementById('feedback-message');
    feedbackMessage.innerText = ''; // Limpar mensagens anteriores

    // Verificar se uma forma de pagamento foi selecionada
    if (!selectedPayment) {
        event.preventDefault();
        feedbackMessage.innerText = 'Por favor, selecione uma forma de pagamento.';
        return;
    }

    // Se cartão de crédito ou débito foi escolhido, verificar os campos
    if ((selectedPayment === 'credit-card' || selectedPayment === 'debit-card') && 
        (!document.getElementById('cardNumber').value.trim() || 
         !document.getElementById('expiryDate').value.trim() || 
         !document.getElementById('cvv').value.trim())) {
        event.preventDefault();
        feedbackMessage.innerText = 'Por favor, preencha todos os dados do cartão.';
        return;
    }

    // Enviar dados para o backend via fetch
    const total = document.querySelector("input[name='valor_total']").value;
    const paymentMethod = selectedPayment;

    fetch('../backend/processar_pagamento.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            valor_total: total,
            metodo_pagamento: paymentMethod
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Exibir modal de sucesso com a mensagem retornada do backend
            openModal(data.message);
        } else {
            // Exibir mensagem de erro
            feedbackMessage.innerText = data.message;
        }
    })
    .catch(error => {
        feedbackMessage.innerText = 'Erro ao processar o pagamento. Tente novamente.';
        console.error('Erro:', error);
    });

    // Prevenir envio padrão do formulário, pois a requisição será feita via JavaScript
    event.preventDefault();
});
// Função para abrir o modal
function openModal(message) {
    document.getElementById('modal-message').innerText = message;
    document.getElementById('paymentModal').style.display = 'block';
}

// Função para fechar o modal
function closeModal() {
    document.getElementById('paymentModal').style.display = 'none';
}

// Fechar o modal ao clicar fora da área do conteúdo
window.onclick = function(event) {
    if (event.target == document.getElementById('paymentModal')) {
        closeModal();
    }
}

window.addEventListener('DOMContentLoaded', function () {
    // Máscara para o número do cartão (XXXX-XXXX-XXXX-XXXX)
    const cardNumberInput = document.getElementById('cardNumber');
    const cardNumberMask = new Inputmask('9999-9999-9999-9999');
    cardNumberMask.mask(cardNumberInput);

    // Máscara para a data de validade (MM/AA)
    const expiryDateInput = document.getElementById('expiryDate');
    const expiryDateMask = new Inputmask('99/99');
    expiryDateMask.mask(expiryDateInput);

    // Máscara para o CVV (XXX)
    const cvvInput = document.getElementById('cvv');
    const cvvMask = new Inputmask('999');
    cvvMask.mask(cvvInput);
});



</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdn.jsdelivr.net/npm/inputmask/dist/inputmask.min.js"></script>


</body>
</html>
