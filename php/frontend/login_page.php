<!DOCTYPE html>
<html lang="pt-br">
<?php
$pageTitle = 'Faça seu login';
include_once('../head.php');
?>
<link rel="stylesheet" href="../css/login.css">
<?php
    $pageLabel = "Login"; 
    include '../navbar1.php';
?>
<body>
    <div class="container">
        <div class="row">
            <!-- Coluna para a imagem -->
            <div class="col-md-6">
                <img src="../../images/image.png" alt="Imagem" class="img-fluid">
            </div>

            <!-- Coluna para o formulário -->
            <div class="col-md-6">
                <h2><strong>FAÇA SEU LOGIN</strong></h2>
                <p id="acessar" style="margin-right:8%; margin-left: -85%;">Acesse sua conta inserindo seus dados abaixo:</p>

                <!-- Exibição de mensagem de erro -->
                <?php if (isset($_GET['message'])): ?>
                    <div class="error-message" id="error-message">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                    </div>
                <?php endif; ?>

                <form action="\THE-OTTER\php\backend\login.php" method="POST">
                    <div class="input-row">
                        <!-- E-mail ou CPF -->
                        <div class="form-group">
                            <div class="input-wrapper">
                                <i class="bi bi-person"></i> <!-- Ícone de Person -->
                                <input type="text" class="form-control" id="emailOrCpf" name="emailOrCpf" placeholder="E-mail ou CPF*" required
                                    pattern="^[\w\.\+\-]+\@[\w]+\.[a-z]{2,3}$|^\d{3}\.\d{3}\.\d{3}-\d{2}$" title="Insira um e-mail válido ou um CPF no formato XXX.XXX.XXX-XX" 
                                    oninput="maskInput(this)">
                            </div>
                        </div>

                        <!-- Senha -->
                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Senha*" required minlength="8" maxlength="16" title="A senha deve ter entre 8 e 16 caracteres">
                            <i class="fas fa-eye-slash" id="togglePassword" onclick="togglePasswordVisibility()"></i> <!-- Ícone de olho -->
                        </div>
                    </div>
                    <p>Não tem uma conta? <a href="cadastro_page.php">Crie uma aqui!</a></p>
                    <div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <script>
        // Função JavaScript para alternar a visibilidade da senha
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePassword");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            }
        }

        // Função para aplicar a máscara de CPF apenas quando necessário
        function maskInput(input) {
            var value = input.value;
            
            // Verifica se a entrada contém apenas números e é menor ou igual a 11 caracteres
            if (/^\d+$/.test(value) && value.length <= 11) {
                // Aplica a máscara de CPF apenas se for numérico
                input.value = value.replace(/\D/g, '').replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            } else {
                // Se não for número, não aplica a máscara
                return;
            }
        }

        // Validação de e-mail ou CPF
        document.querySelector("form").addEventListener("submit", function(event) {
            var emailOrCpf = document.getElementById("emailOrCpf").value;

            // Verifica se é um e-mail
            if (emailOrCpf.includes('@')) {
                // Validação do formato de e-mail
                var emailPattern = /^[\w\.\+\-]+\@[\w]+\.[a-z]{2,3}$/;
                if (!emailPattern.test(emailOrCpf)) {
                    event.preventDefault();  // Impede o envio do formulário
                    alert("Por favor, insira um e-mail válido.");
                }
            }
        });

        // Função para remover a mensagem de erro após 5 segundos
        window.onload = function() {
            var errorMessage = document.getElementById("error-message");
            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.display = "none"; // Esconde a mensagem de erro
                }, 10000); // 5000 milissegundos = 5 segundos
            }
        };
    </script>
</body>
</html>
