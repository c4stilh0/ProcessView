<?php
include('conexao.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {
    if (strlen($_POST['email']) == 0) {
        echo "Preencha seu email";
    } else if (strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {
        $email = $conn ->real_escape_string($_POST['email']);
        $senha = $conn ->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM cadastro1 WHERE email='$email' AND senha='$senha'";
        $sql_query = $conn ->query($sql_code) or die("Falha na execução do código SQL: " . $conn ->error);
        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            $cadastro1 = $sql_query->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $cadatro1['id'];
            $_SESSION['verificacao'] = $cadatro1['verificacao'];

            header("Location: painel.php");
            exit();
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        } 
    }
}
?>