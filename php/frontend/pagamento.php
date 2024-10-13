<?php
session_start(); // Inicia a sessão

// Verifica se o total está definido na sessão
$total = isset($_SESSION['ver_carrinho']) ? $_SESSION['ver_carrinho'] : 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
    
<?php
$pageTitle = 'Finalizar Compra - Snack Bar';
include_once('../head.php');
?>

<body style="background-color: #001d2f; color: #e3cbbc; font-family: 'League Spartan', sans-serif;">

    <nav class="navbar fixed-top navbar-dark" style="background-color: #001d2f;">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="ver_carrinho.php" class="navbar-brand" style="color: #e3cbbc; margin-left: 180px;">
                <i class="fas fa-arrow-left"></i>
            </a>
            <span class="navbar-brand mx-auto" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-size: 18px;">
                Finalizar Compra
            </span>
            <a href="#" class="navbar-brand" style="color: #e3cbbc; margin-right: 200px;">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </nav>

    <div style="padding-top: 80px;">
        <div class="container">
            <h2 class="text-center" style="margin: 20px 0;"> Pagamento</h2>
            <!-- Exibir valor total aqui -->
            <p>Subtotal: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div class="payment-option" id="credit-card"
                        style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s;"
                        onclick="selectPayment('credit-card')">
                        <i class="fas fa-credit-card" style="font-size: 24px; margin-right: 10px;"></i>
                        <h5 style="display: inline;">Cartão de Crédito</h5>
                    </div>
                    <div class="payment-option" id="debit-card"
                        style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s;"
                        onclick="selectPayment('debit-card')">
                        <i class="fas fa-credit-card" style="font-size: 24px; margin-right: 10px;"></i>
                        <h5 style="display: inline;">Cartão de Débito</h5>
                    </div>
                    <div class="payment-option" id="pix"
                        style="cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 15px; transition: border-color 0.3s;"
                        onclick="selectPayment('pix')">
                        <i class="fas fa-money-bill-wave" style="font-size: 24px; margin-right: 10px;"></i>
                        <h5 style="display: inline;">PIX</h5>
                    </div>
                    <canvas id="qr-code" style="margin-top: 20px; display: none;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer fixo com design consistente -->
    <footer class="fixed-bottom" style="background-color: #001d2f; padding: 15px 0;">
        <div class="container text-center">
            <button id="confirm-footer-button" class="btn btn-primary" disabled
                style="background-color: #001d2f; color: #e3cbbc; padding: 10px 20px; border: none; font-weight: bold; font-size: 18px;"
                onclick="confirmPurchase()">
                CONFIRMAR COMPRA
            </button>
        </div>
    </footer>

    <!-- Modal para confirmação de pagamento -->
    <div class="modal fade" id="paymentConfirmationModal" tabindex="-1" aria-labelledby="paymentConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #001d2f; color: #e3cbbc;">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentConfirmationModalLabel">Pagamento Confirmado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Seu pagamento foi confirmado com sucesso! Obrigado pela sua compra.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedPayment = null;
        const qrCodeCanvas = document.getElementById('qr-code');
        const qr = new QRious({
            element: qrCodeCanvas,
            size: 200, // Tamanho do QR Code
            value: '', // Valor inicial vazio
        });

        // Recupera o valor total passado pela URL
        const urlParams = new URLSearchParams(window.location.search);
        const total = urlParams.get('total');
        document.getElementById('valor-total').innerText = `Valor Total: R$ ${parseFloat(total).toFixed(2).replace('.', ',')}`;

        function selectPayment(paymentMethod) {
            // Remove a seleção anterior
            const paymentOptions = document.querySelectorAll('.payment-option');
            paymentOptions.forEach(option => {
                option.style.borderColor = 'transparent'; // Reseta a borda
            });

            // Adiciona a borda à opção selecionada
            const selectedOption = document.getElementById(paymentMethod);
            selectedOption.style.borderColor = '#e3cbbc'; // Define a borda da opção selecionada
            selectedPayment = paymentMethod;

            // Ativa o botão de confirmação no footer
            document.getElementById('confirm-footer-button').disabled = false;

            // Limpa o canvas do QR Code
            qrCodeCanvas.style.display = 'none';
            qr.set({
                value: ''
            });

            // Gera o QR Code se a opção PIX for selecionada
            if (paymentMethod === 'pix') {
                const valorPix = total; // Usar o total do pagamento
                const pixQRCodeValue = `00020101021126790014BR.GOV.BCB.PIX01368300000000000D024${valorPix.replace('.', '')}00`; // Exemplo de string para gerar o código QR
                qr.set({
                    value: pixQRCodeValue
                });
                qrCodeCanvas.style.display = 'block'; // Mostra o QR Code
            }
        }

        function confirmPurchase() {
            if (selectedPayment) {
                // Mostra o modal de confirmação
                const paymentConfirmationModal = new bootstrap.Modal(document.getElementById('paymentConfirmationModal'));
                paymentConfirmationModal.show();
            } else {
                alert('Por favor, selecione uma forma de pagamento.');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>