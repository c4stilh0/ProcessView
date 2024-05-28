<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
    die("Você não pode acessar essa página porque não está logado. <p><a href='login-cliente.html'>Entrar</a></p>");
    exit;

}

$id = $_SESSION['id'];
$name = $_SESSION['name'];
?>

<!DOCTYPE html>     
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($name); ?>!</h1>
    <p>Seu ID é: <?php echo htmlspecialchars($id); ?></p>
    <a href="sair.php">Sair</a>
</body>
</html>
