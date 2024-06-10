<?php
require 'conexao2.php';
include 'conexao.php';

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
            $_SESSION['id'] = $cadastro1['id'];
            $_SESSION['verificacao'] = $cadatro1['verificacao'];

            if (!$pdo) {
                die("Erro: Variável \$pdo não está definida. Verifique sua conexão com o banco de dados.");
            }
            
            if (isset($_POST['email'])) {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            
                try {
                    // Verifica o usuário no banco de dados
                    $stmt = $pdo->prepare("SELECT id, tipo FROM cadastro1 WHERE email = :email");
                    $stmt->bindValue(':email', $email);
                    $stmt->execute();
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
                    if ($usuario) {
                        if (!isset($_SESSION)) {
                            session_start();
                        }
            
                        // Armazena informações do usuário na sessão
                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['tipo'] = $usuario['tipo'];
            
                        // Redireciona com base no tipo de usuário
                        if ($usuario['tipo'] == 'advogado') {
                            header("Location: tela-advogado.php");
                            exit();
                        } else {
                            header("Location: list_file.php");
                            exit();
                        }
                    } else {
                        echo "Falha ao logar! E-mail incorreto.";
                    }
                } catch (PDOException $e) {
                    die("Erro ao verificar usuário: " . $e->getMessage());
                }
            }

            exit();
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        } 
    }
}
?>