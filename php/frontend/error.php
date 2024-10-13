<!DOCTYPE html>
<html lang="pt-br">

<?php
$pageTitle = 'Erro de login';
include_once('../head.php');
?>

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
        <a href="../../html/login.html" class="btn" style="width: 40%; background-color: #e3cbbc; color: #001d2f; border: none; width: 200px; padding: 15px 0; font-size: 18px; border-radius: 20px; font-family: 'League Spartan', sans-serif; text-decoration: none; display: inline-block; text-align: center;">Voltar</a>
    </div>
</body>
</html>
