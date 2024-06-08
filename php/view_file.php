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
            // Defina os headers para exibição do arquivo PDF
            header('Content-Type: ' . $arquivo['arquivo_tipo']);
            header('Content-Disposition: inline; filename="' . $arquivo['arquivo_nome'] . '"');
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
