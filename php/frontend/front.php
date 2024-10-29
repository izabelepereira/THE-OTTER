<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Crie sua conta';
include_once('../head.php');
?>
<link rel="stylesheet" href="../css/front.css">

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
            <h2 class="header-title">
              CRIE SUA CONTA PARA GANHAR DESCONTOS!
            </h2>
            <form action="../backend/back.php" method="post" id="signupForm">
              <h5 class="section-title">
                PREENCHA COM SEUS DADOS:
              </h5>
              <div class="form-group mt-2 mb-1">
                  <input type="text" class="form-control text-input" name="nome" id="nome" placeholder="Nome completo*">
              </div>
              <div class="row gx-1">
                <div class="form-group col-md-6 mb-1">
                  <select id="genero" class="form-control text-input" name="genero">
                    <option value="" disabled selected>Gênero*</option>
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
                  <input type="text" class="form-control text-input" name="cpf" id="cpf" placeholder="CPF*" oninput="mascaraCpf(this)">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control text-input" name="dataNascimento" id="dataNascimento" placeholder="Data de nascimento*">
                </div>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="usarMesmoCPF" name="usarMesmoCPF" autocomplete="off">
                <label class="form-check-label text-light" for="usarMesmoCPF">Usar o mesmo CPF para notas fiscais e recibos</label>
              </div>
              <h2 class="section-title mt-5 mb-1">
                INFORMAÇÕES DE CONTATO
              </h2>
              <div class="row gx-1">
                <div class="form-group col-md-6">
                  <input type="email" class="form-control text-input" name="email" id="email" placeholder="E-mail*">
                </div>
                <div class="form-group col-md-6">
                  <input type="tel" class="form-control text-input" name="telefone" id="telefone" placeholder="Telefone*" oninput="mascaraTelefone(this)">
                </div>
              </div>
              <h2 class="section-title mt-5 mb-1">
                CRIE SUA SENHA
              </h2>
              <div class="row gx-1">
                <div class="form-group col-md-6">
                  <input type="password" class="form-control text-input" name="senha" id="senha" placeholder="Senha*">
                </div>
                <div class="form-group col-md-6">
                  <input type="password" class="form-control text-input" name="senhaconfirm" id="senhaconfirm" placeholder="Confirmar senha*">
                </div>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="declaracao" name="declaracao" autocomplete="off">
                <label class="form-check-label text-light" for="declaracao">Declaro que todas informações aqui são verdadeiras</label>
              </div>

              <footer class="fixed-bottom footer">
                <form class="form-inline justify-content-center">
                  <button type="submit" class="btn btn-cadastrar">
                    CADASTRAR
                  </button>
                </form>
              </footer>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      flatpickr("#dataNascimento", {
        dateFormat: "d/m/Y",
        placeholder: "Data de nascimento*",
        locale: "pt"
      });
    </script>
    <script>
    function mascaraTelefone(telefone) {
    let value = telefone.value.replace(/\D/g, ''); // Remove tudo que não é dígito
    if (value.length > 11) {
        value = value.slice(0, 11); // Limita a 11 dígitos
    }
    // Aplica a máscara
    if (value.length > 6) {
        value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3'); // Formato para números com 9 dígitos
    } else if (value.length > 2) {
        value = value.replace(/^(\d{2})(\d{4,5})$/, '($1) $2'); // Formato para números com 8 ou 9 dígitos
    } else if (value.length > 0) {
        value = value.replace(/^(\d{2})/, '($1'); // Formato inicial
    }
    telefone.value = value; // Atualiza o campo de entrada com a máscara aplicada
}

function mascaraCpf(cpf) {
    let value = cpf.value.replace(/\D/g, ''); // Remove tudo que não é dígito
    if (value.length > 11) {
        value = value.slice(0, 11); // Limita a 11 dígitos
    }
    // Aplica a máscara
    if (value.length === 11) {
        value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4'); // CPF completo
    } else if (value.length > 6) {
        value = value.replace(/^(\d{3})(\d{3})(\d{1})$/, '$1.$2-$3'); // Primeiro grupo com máscara
    } else if (value.length > 3) {
        value = value.replace(/^(\d{3})(\d{1})$/, '$1.$2'); // Dois grupos com máscara
    } else if (value.length > 0) {
        value = value.replace(/^(\d{1,3})/, '$1'); // Apenas números
    }
    cpf.value = value; // Atualiza o campo de entrada com a máscara aplicada
}

</script> <!-- Certifique-se de usar o caminho correto -->


</body>

</html>
