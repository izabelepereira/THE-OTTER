<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crie sua conta</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #001d2f;" class="text-light">

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #001d2f; padding: 1rem 2rem;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; margin-left: 60px; margin-right: 50px;">
      <img src="theotter1.png" alt="Logo" style="width: 150px; height: 20px;" class="d-inline-block align-middle">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto" style="gap: 40px;">
        <a class="nav-link" href="#" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 18px; align-self: center;">PROGRAMAÇÃO</a>
        <a class="nav-link" href="#" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 18px; align-self: center;">SNACKBAR</a>
        <a class="nav-link" href="#" style="color: #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 18px; align-self: center;">SUA SESSÃO</a>
      </div>
      <div class="d-flex" style="gap: 10px;">
  <button class="btn" type="button" style="color: #e3cbbc; border: none; background-color: transparent; padding: 0;">
    <i class="bi bi-search" style="font-size: 20px; color: #e3cbbc; text-shadow: 0 0 2px rgba(0,0,0,0.5);"></i>
  </button>
  <button class="btn" type="button" style="color: #e3cbbc; border: none; background-color: transparent; padding: 0;">
    <i class="bi bi-list" style="font-size: 20px; color: #e3cbbc; text-shadow: 0 0 2px rgba(0,0,0,0.5);"></i>
  </button>
</div>
    </div>
  </div>
</nav>

<div class="full-width-container" style="width: 85%; margin: 0 auto; border-radius: 20px; overflow: hidden;">
    <img src="snack3.png" alt="Imagem" style="width: 100%; height: auto; display: block;">
</div>

<div style="text-align: center; color: #e3cbbc; padding: 10px; border-bottom: 3px solid #e3cbbc; margin-top: 3px; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 18px;">
    <p style="margin: 0; font-size: 20px;">BEBIDAS E GULOSEIMAS</p>
  </div>

<div style="display: flex; justify-content: center; align-items: center; padding: 20px; gap: 20px;">
        <img src="comer.png" alt="Imagem 1" style="width: 20%; height: auto; margin: 0 10px; margin-right: 180px; border-radius: 20px"
        onclick="window.location.href='snack.php'" style="cursor: pointer;">
        <img src="beber1.png" alt="Imagem 2" style="width: 20%; height: auto; margin: 0 10px; border-radius: 20px">
    </div>

  <!-- Seção de Combos -->
  <div style="text-align: center; background-color: #0c344b; color: #e3cbbc; padding: 25px; border-bottom: 2px solid #e3cbbc; font-family: 'League Spartan', sans-serif; font-weight: bold; font-size: 18px; margin-top: 30px; margin-bottom: 3px; border-top: 3px solid #e3cbbc;">
    <h2 style="margin: 0;">combos</h2>
  </div>
  <div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php
        $servername = "localhost";
        $username = "root";
        $password = ""; // Sua senha do banco de dados
        $dbname = "theotter"; // Nome do seu banco de dados

        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Consultar combos
        $sql = "SELECT nome, descricao, imagem FROM produtos WHERE categoria = 'combos'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col">
                        <div class="d-flex align-items-center border p-2">
                          <img src="' . htmlspecialchars($row['imagem']) . '" alt="' . htmlspecialchars($row['nome']) . '" class="img-fluid" style="width: 150px; height: auto; margin-right: 15px;">
                          <div>
                            <h5>' . htmlspecialchars($row['nome']) . '</h5>
                            <p>' . htmlspecialchars($row['descricao']) . '</p>
                            <a href="#" class="btn btn-primary">+</a>
                          </div>
                        </div>
                      </div>';
            }
        } else {
            echo '<div class="col"><p>Nenhum produto encontrado na categoria combos.</p></div>';
        }

        $conn->close();
      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
