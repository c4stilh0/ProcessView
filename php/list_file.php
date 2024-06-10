<?php
require 'database.php';

$cpf = '';
$processos = [];

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];
    try {
        // Prepare a query para selecionar os processos pelo CPF
        $stmt = $pdo->prepare("SELECT id, numero_processo, tipo, nome, cpf FROM processos WHERE cpf = :cpf");
        $stmt->bindValue(':cpf', $cpf);
        $stmt->execute();
        $processos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($processos)) {
            echo "Nenhum processo encontrado para este CPF.";
        }
    } catch (PDOException $e) {
        die("Erro ao buscar os processos: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process View</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/media-query.css">
    <link rel="stylesheet" href="../css/processos.css">
    
</head>
<body>
    <main>
        <div class="elipse1"></div>
        <div class="elipse2"></div>
        <div class="elipse3"></div>
        
        <section id="processos">
            <h1>Bem Vindo ao Process View, seu Gerenciador de<br> Processos Judiciais</h1>
            <form method="get" action="">
                <div class="pesquisa">
                    <input type="search" name="cpf" id="cpf" placeholder="Pesquisar por CPF">
                    <input type="submit" value="Consultar">
                </div>
            </form>
            <div id="parte2">
                <div class="containerProcessos">
                    <?php if (!empty($processos)): ?>
                        <h2>Processos Correspondentes:</h2>
                        <ul>
                            <?php foreach ($processos as $processo): ?>
                            <div class="containerLi">
                                <li>
                                    <strong>Assunto:</strong> <?php echo htmlspecialchars($processo['nome']); ?><br>
                                    <strong>Tipo:</strong> <?php echo htmlspecialchars($processo['tipo']); ?><br>
                                    <strong>CPF do participante:</strong> <?php echo htmlspecialchars($processo['cpf']); ?><br>
                                    <div class="viewFile">
                                        <a href="view_file.php?id=<?php echo $processo['id']; ?>">Visualizar Arquivo</a>
                                    </div>
                                </li>
                            </div>                             
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </br>
            </div>            
        </section>
    </main>
</body>
</html>
