<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifique se todos os campos estão preenchidos
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK &&
        isset($_POST['nome']) && isset($_POST['numero_processo']) &&
        isset($_POST['tipo']) && isset($_POST['data']) && isset($_POST['cpf'])) {

        // Pegue as informações do arquivo
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Verifique se o arquivo é um PDF
        if ($fileType != 'application/pdf') {
            die("Erro: Apenas arquivos PDF são permitidos.");
        }

        // Leia o conteúdo do arquivo
        $fileContent = file_get_contents($fileTmpPath);

        // Pegue os dados do formulário
        $nome = $_POST['nome'];
        $numero_processo = $_POST['numero_processo'];
        $tipo = $_POST['tipo'];
        $data = $_POST['data'];
        $cpf = $_POST['cpf'];

        try {
            // Prepare a query para inserir os dados e o arquivo no banco de dados
            $stmt = $pdo->prepare("INSERT INTO processos (nome, numero_processo, tipo, data, cpf, arquivo_nome, arquivo_tamanho, arquivo_tipo, arquivo_conteudo) VALUES (:nome, :numero_processo, :tipo, :data, :cpf, :arquivo_nome, :arquivo_tamanho, :arquivo_tipo, :arquivo_conteudo)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':numero_processo', $numero_processo);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':arquivo_nome', $fileName);
            $stmt->bindParam(':arquivo_tamanho', $fileSize);
            $stmt->bindParam(':arquivo_tipo', $fileType);
            $stmt->bindParam(':arquivo_conteudo', $fileContent, PDO::PARAM_LOB);

            // Execute a query
            $stmt->execute();

            echo "Processo cadastrado e arquivo enviado com sucesso!";
            
        } catch (PDOException $e) {
            echo "Erro ao salvar o processo: " . $e->getMessage();
        }
    } else {
        echo "Erro: Por favor, preencha todos os campos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
