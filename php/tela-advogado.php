<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'advogado') {    
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Advogado</title>
</head>
<body>
    <h1>Bem-vindo ao Painel do Advogado</h1>
</body>
</html>
