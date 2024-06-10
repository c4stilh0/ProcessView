<?php
require 'banco.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Prepare a query para selecionar o arquivo pelo ID
        $stmt = $pdo->prepare("SELECT arquivo_nome, arquivo_tipo, arquivo_conteudo FROM processos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $arquivo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($arquivo) {
            // Define os headers para download do arquivo
            header('Content-Description: File Transfer');
            header('Content-Type: ' . $arquivo['arquivo_tipo']);
            header('Content-Disposition: attachment; filename=' . $arquivo['arquivo_nome']);
            header('Content-Length: ' . strlen($arquivo['arquivo_conteudo']));
            echo $arquivo['arquivo_conteudo'];
        } else {
            echo "Arquivo não encontrado.";
        }
    } catch (PDOException $e) {
        die("Erro ao buscar o arquivo: " . $e->getMessage());
    }
} else {
    echo "ID do arquivo não fornecido.";
}
?>
