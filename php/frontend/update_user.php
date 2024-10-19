<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Ajuste de Usuário';
include_once('../head.php');
?>

<body style="background-color: #001d2f;" class="text-light">
  <nav class="navbar fixed-top navbar-dark" style="background-color: #001d2f;">
    <div class="container d-flex justify-content-between align-items-center">
      <a href="#" class="navbar-brand" style="color: #e3cbbc; margin-left: 180px;">
        <i class="fas fa-arrow-left"></i>
      </a>
      <a href="#" class="navbar-brand mx-auto">
        <img src="../../images/theotter1.png" alt="Logo" class="img-fluid" style="height: 20px;">
      </a>
      <a href="#" class="navbar-brand" style="color: #e3cbbc; margin-right: 200px;">
        <i class="fas fa-times"></i>
      </a>
    </div>
  </nav>
  <div class="container mt-5 py-4" style="max-width: 800px; margin-bottom: 100px;">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-0 bg-dark">
          <div class="card-body" style="background-color: #001d2f;">
            <h2 class="text-left" style="font-family: 'League Spartan', sans-serif; color: #e3cbbc; font-weight: bold; font-size: 19px;">
              AJUSTE SEUS DADOS
            </h2>
            <form action="update_user.php" method="post" id="updateForm">
              <h5 class="text-left" style="font-family: 'League Spartan', sans-serif; color: #e3cbbc; font-weight: bold; font-size: 18px; margin-top: 20px;">
                ATUALIZE SUAS INFORMAÇÕES:
              </h5>
              <div class="form-group mt-2 mb-1">
                <div class="form-floating">
                  <input type="text" class="form-control border-0 p-4 text-light" name="nome" id="nome" placeholder="Nome completo*" style="background-color: #0c344b; border-radius: 15px;" required>
                </div>
              </div>
              <div class="row gx-1">
                <div class="form-group col-md-6 mb-1">
                  <select id="genero" class="form-control border-0 p-4 select-placeholder" name="genero" style="background-color: #0c344b; border-radius: 15px;" required>
                    <option value="" disabled selected>Gênero*</option>
                    <option value="feminino">Feminino</option>
                    <option value="masculino">Masculino</option>
                    <option value="outro">Outro</option>
                  </select>
                </div>
                <div class="form-group col-md-6 mb-1">
                  <input type="text" class="form-control border-0 p-4" name="apelido" id="apelido" placeholder="Como gostaria de ser chamado(a)?" style="background-color: #0c344b; color: #ffffff; border-radius: 15px;" required>
                </div>
              </div>
              <div class="row gx-1">
                <div class="form-group col-md-6 mb-1">
                  <input type="text" class="form-control border-0 p-4" name="cpf" id="cpf" placeholder="CPF*" style="background-color: #0c344b; border-radius: 15px;" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control border-0 p-4" name="dataNascimento" id="dataNascimento" style="background-color: #0c344b; border-radius: 15px;" placeholder="Data de nascimento*" required>
                </div>
              </div>
              <footer class="fixed-bottom" style="background-color: #021c2d; color: #ffffff; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 20px; text-align: center; padding: 10px;">
                <form class="form-inline justify-content-center">
                  <button type="submit" class="btn"
                    style="background-color: #021c2d; color: #1a4a67; border: none; border-radius: 8px; padding: 15px 30px; font-size: 20px; font-weight: bold; transition: background-color 0.3s, color 0.3s;"
                    onmouseover="this.style.backgroundColor='#021c2d'; this.style.color='#e3cbbc';"
                    onmouseout="this.style.backgroundColor='#021c2d'; this.style.color='#1a4a67';">
                    ATUALIZAR
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
        locale: "pt" // Configura o idioma para português, se necessário
      });
    </script>
</body>

</html>
