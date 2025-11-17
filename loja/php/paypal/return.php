<?php
require __DIR__ . "/capture_order.php";

if (!isset($_GET["token"])) {
    echo "Token não encontrado.";
    exit;
}

$orderId = $_GET["token"];

$config = require __DIR__ . "/config.php";

$capture = captureOrder($orderId, $config);

// EXIBIR RESULTADO
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagamento</title>
</head>
<body>
<?php if (isset($capture["status"]) && $capture["status"] === "COMPLETED"): ?>
    <h1>Pagamento aprovado com sucesso!</h1>
    <p>Obrigado pela compra!</p>

    <pre><?= json_encode($capture, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?></pre>

    <a href="/vendas.php">Voltar para a loja</a>

<?php else: ?>

    <h1>Falha ao capturar pagamento</h1>
    <pre><?= json_encode($capture, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?></pre>

<?php endif; ?>
</body>
</html>
