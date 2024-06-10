<?php

session_start();

// Verifica se a conexão com o banco de dados foi estabelecida corretamente
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
?>
