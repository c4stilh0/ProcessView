<?php
include('conexao.php'); // Inclua aqui o arquivo de conexão ao banco de dados

if (isset($_POST['cpf']) && isset($_POST['email']) && isset($_POST['senha'])) {
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = password_hash($mysqli->real_escape_string($_POST['senha']), PASSWORD_DEFAULT); // Hash da senha

    // Verificação se o email ou CPF já existem
    $sql_check = "SELECT * FROM usuario WHERE email='$email' OR cpf='$cpf'";
    $result_check = $mysqli->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "Erro: O email ou CPF já está cadastrado!";
    } else {
        // Inserção no banco de dados
        $sql_insert = "INSERT INTO usuario (cpf, email, senha) VALUES ('$cpf', '$email', '$senha')";

        if ($mysqli->query($sql_insert)) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar usuário: " . $mysqli->error;
        }
    }
} else {
    echo "Preencha todos os campos!";
}
?>
