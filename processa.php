<?php
session_start();
include_once("php/conexao.php");

// Sanitizar as entradas
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

// Verificar se as variáveis foram definidas corretamente
if (!$cpf || !$email || !$senha) {
    die("Erro: Entrada inválida.");
}

// Corrigir o comando SQL
$result_usuario = "INSERT INTO cadastro1 (email, cpf, senha, created_at) VALUES ('$email', '$cpf', '$senha', NOW())";

// Executar a query e capturar erros
if (mysqli_query($conn, $result_usuario)) {
    // Verificar se o usuário foi inserido com sucesso
    if(mysqli_insert_id($conn)){
        $_SESSION['msg'] = "<p style='color:green;'>Usuário cadastrado com sucesso</p>";
        header("Location: php/tela-processos.php");
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Usuário não foi cadastrado com sucesso</p>";
        header("Location: cadastro.html");
    }
} else {
    // Capturar e exibir o erro de SQL
    $error_message = mysqli_error($conn);
    $_SESSION['msg'] = "<p style='color:red;'>Erro no cadastro: $error_message</p>";
    header("Location: cadastro.html");
}
?>
