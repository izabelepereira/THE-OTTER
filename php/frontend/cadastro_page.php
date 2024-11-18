<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Crie sua conta';
include_once('../head.php');
?>
<link rel="stylesheet" href="../css/cadastro.css">

<body class="text-light bg-body">
    <?php
    $pageLabel = "cadastro"; 
    include '../navbar1.php';
    ?>

    <div class="container mt-5 py-4 cadastro-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 bg-dark">
                    <div class="card-body">
                        <h2 class="header-title">CRIE SUA CONTA PARA GANHAR DESCONTOS!</h2>

                        <!-- Exibição de mensagens de erro e sucesso -->
                        <div id="messages">
                            <?php
                            // Exibe mensagens de erro ou sucesso da sessão
                            if (isset($_SESSION['status'])) {
                                if ($_SESSION['status'] == 'success') {
                                    echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
                                } elseif ($_SESSION['status'] == 'error') {
                                    echo '<div class="alert alert-danger">' . $_SESSION['message'] . '</div>';
                                }
                                // Limpa as variáveis de sessão após mostrar a mensagem
                                unset($_SESSION['status']);
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>

                    <form  id="signupForm" action="/THE-OTTER/php/backend/cadastro.php" method="POST" onsubmit="return validarCampos()">
                            <h5 class="section-title">PREENCHA COM SEUS DADOS:</h5>
                            <div class="form-group mt-2 mb-1">
                                <input type="text" class="form-control text-input" name="nome" id="nome" placeholder="Nome completo*" required>
                            </div>
                            <div class="row gx-1">
                                <div class="form-group col-md-6 mb-1">
                                    <select id="genero" class="form-control text-input" name="genero" required>
                                        <option value="" disabled selected class="placeholder">Gênero*</option>
                                        <option value="feminino">Feminino</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="outro">Outro</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mb-1">
                                    <input type="text" class="form-control text-input" name="apelido" id="apelido" placeholder="Como gostaria de ser chamado(a)?">
                                </div>
                            </div>
                            <div class="row gx-1">
                                <div class="form-group col-md-6 mb-1">
                                    <input type="text" class="form-control text-input" name="cpf" id="cpf" placeholder="CPF*" oninput="mascaraCpf(this)" required>
                                    <span id="cpfError" class="text-danger" style="display: none;">CPF inválido</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control text-input" name="dataNascimento" id="dataNascimento" placeholder="Data de nascimento*" required>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="usarMesmoCPF" name="usarMesmoCPF" autocomplete="off">
                                <label class="form-check-label text-light" for="usarMesmoCPF">Usar o mesmo CPF para notas fiscais e recibos</label>
                            </div>
                            <h2 class="section-title mt-5 mb-1">INFORMAÇÕES DE CONTATO</h2>
                            <div class="row gx-1">
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control text-input" name="email" id="email" placeholder="E-mail*" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="tel" class="form-control text-input" name="telefone" id="telefone" placeholder="Telefone*" oninput="mascaraTelefone(this)" required>
                                    <span id="telefoneError" class="text-danger" style="display: none;">Número de telefone inválido</span>
                                </div>
                            </div>
                            <h2 class="section-title mt-5 mb-1">CRIE SUA SENHA</h2>
                            <div class="row gx-1">
                                <div class="form-group col-md-6">
                                    <input type="password" class="form-control text-input" name="senha" id="senha" placeholder="Senha*" required minlength="8" maxlength="16">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="password" class="form-control text-input" name="senhaconfirm" id="senhaconfirm" placeholder="Confirmar senha*" required>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="declaracao" name="declaracao" autocomplete="off" required>
                                <label class="form-check-label text-light" for="declaracao">Declaro que todas informações aqui são verdadeiras</label>
                            </div>

                            <footer class="fixed-bottom footer">
                            <form class="form-inline justify-content-center">
                                <button type="submit" form="signupForm" class="btn btn-cadastrar">
                                    CADASTRAR
                                </button>
                            </form>
                        </footer>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Máscara de telefone
        function mascaraTelefone(telefone) {
            let value = telefone.value.replace(/\D/g, '');
            value = value.slice(0, 11); // Limita a 11 caracteres
            telefone.value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }

        // Máscara de CPF
        function mascaraCpf(cpf) {
            let value = cpf.value.replace(/\D/g, '');
            value = value.slice(0, 11); // Limita a 11 caracteres
            cpf.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        }

        // Função de validação antes de submeter o formulário
        function validarCampos() {
            let cpf = document.getElementById("cpf").value.replace(/\D/g, '');
            let telefone = document.getElementById("telefone").value.replace(/\D/g, '');
            let isValid = true;

            // Valida CPF
            if (cpf.length !== 11) {
                document.getElementById("cpfError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("cpfError").style.display = "none";
            }

            // Valida Telefone
            if (telefone.length !== 11) {
                document.getElementById("telefoneError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("telefoneError").style.display = "none";
            }

            return isValid; // Se qualquer campo for inválido, o formulário não será enviado
        }

        // Inicializa o calendário (flatpickr)
        function initFlatpickr() {
            const inputDate = document.getElementById('dataNascimento');
            if (window.innerWidth > 768) {
                flatpickr(inputDate, { dateFormat: "d/m/Y", locale: "pt" });
            } else {
                inputDate.type = "date";
            }
        }
        window.onload = initFlatpickr;
        window.onresize = initFlatpickr;
    </script>
</body>
</html>
