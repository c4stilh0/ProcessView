<?php
require 'banco.php';

$numero_processo = '';
$processo = null;
?>


<?php if ($processo): ?>
        <h2>Detalhes do Processo</h2>
        <p><strong>Número do Processo:</strong> <?php echo htmlspecialchars($processo['numero_processo']); ?></p>
        <p><strong>Tipo:</strong> <?php echo htmlspecialchars($processo['tipo']); ?></p>
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($processo['nome']); ?></p>
        <a href="view_file.php?id=<?php echo $processo['id']; ?>">Visualizar Arquivo</a>
<?php endif; ?>