<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro de Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body style="background-color: #001d2f; color: #e3cbbc; font-family: 'League Spartan', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div class="container" style="padding: 20px; border-radius: 8px; background-color: #001d2f; text-align: center;">
        <h2 style="color: #e3cbbc; margin-bottom: 15px;">Erro de Login</h2>
        <p>
            <?php
            if (isset($_GET['message'])) {
                echo htmlspecialchars($_GET['message']);
            } else {
                echo "Ocorreu um erro desconhecido.";
            }
            ?>
        </p>
        <a href="login.html" class="btn" style="width: 40%; background-color: #e3cbbc; color: #001d2f; border: none; width: 200px; padding: 15px 0; font-size: 18px; border-radius: 20px; font-family: 'League Spartan', sans-serif; text-decoration: none; display: inline-block; text-align: center;">Voltar</a>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
