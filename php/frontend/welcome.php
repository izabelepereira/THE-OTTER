<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<?php
$pageTitle = 'Bem-vindo';
include_once('../head.php')
?>

<body style="font-family: Arial, sans-serif; background-color: #f8f9fa;">

    <div class="container mt-5">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['emailOrCpf']); ?>!</h1>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>