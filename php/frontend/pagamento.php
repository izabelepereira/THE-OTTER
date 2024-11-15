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

<body style="background-color: #001d2f; color: #e3cbbc; font-family: 'League Spartan', sans-serif;">

<?php
$pageLabel = "Pagamento"; 
include '../navbar1.php';
?>

<div class="container-principal" style="flex-grow: 1;">
    <div class="container" style="display: flex; justify-content: center; align-items: center; height: 80vh;">
        <img id="snackImage" src="../../images/pago.png" alt="Imagem" class="snack-image" style="width: 100%; border-radius: 15px; height: auto;">
    </div>

    <div style="padding-top: 80px;">
        <div class="container">
            <h2 class="text-center" style="margin: 20px 0; margin-top: -10%;">Pagamento</h2>
            <p>Subtotal: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
            
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <!-- Formas de pagamento -->
                    <div class="payment-option" id="credit-card" style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s;" onclick="selectPayment('credit-card')">
                        <i class="fas fa-credit-card" style="font-size: 24px; margin-right: 10px;"></i>
                        <h5 style="display: inline;">Cartão de Crédito</h5>
                    </div>
                    <div class="payment-option" id="debit-card" style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s;" onclick="selectPayment('debit-card')">
                        <i class="fas fa-credit-card" style="font-size: 24px; margin-right: 10px;"></i>
                        <h5 style="display: inline;">Cartão de Débito</h5>
                    </div>
                    <div class="payment-option" id="pix" style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s;" onclick="selectPayment('pix')">
                        <i class="fas fa-money-bill-wave" style="font-size: 24px; margin-right: 10px;"></i>
                        <h5 style="display: inline;">PIX</h5>
                    </div>
                    
                    <p id="payment-message" style="text-align: center; margin-top: 20px;"></p>
                    <p style="text-align: center; margin-top: 20px; font-weight: bold; color: #ff0000;">* Caso tenha dúvidas, entre em contato com nosso suporte.</p>
                    
                    <div id="credit-card-form" style="display: none;">
                        <label for="cardNumber">Número do Cartão</label>
                        <input type="text" id="cardNumber" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX">
                        <label for="expiryDate">Data de Validade</label>
                        <input type="text" id="expiryDate" class="form-control" placeholder="MM/AA">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" class="form-control" placeholder="CVV">
                    </div>
                    
                    <canvas id="qr-code" style="margin-top: 20px; display: none;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer fixo -->
<form action="../backend/processar_pagamento.php" method="POST" id="formPagamento">
    <input type="hidden" name="valor_total" value="<?php echo $total; ?>">
    <input type="hidden" name="payment_method" id="payment_method">
    <button type="submit" id="confirm-footer-button" class="btn btn-primary" disabled style="background-color: #001d2f; color: #e3cbbc; padding: 10px 20px; border: none; font-weight: bold; font-size: 18px;">
        CONFIRMAR COMPRA
    </button>
</form>

<div id="feedback-message" style="color: red; margin-top: 20px; text-align: center;"></div> <!-- Div para exibir mensagens -->

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

    // Validar o formulário antes de enviar
    document.getElementById('formPagamento').addEventListener('submit', function (event) {
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
    });
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>
