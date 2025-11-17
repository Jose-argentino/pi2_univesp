<?php
// detalhesEstoque.php
include "php/partes/validaSession.php";
include "php/partes/conexao.php";
$db = isset($pdo) ? $pdo : $conn;

$id_estoque = $_GET['id'] ?? 0;
if (!$id_estoque) {
    die("ID de estoque não fornecido.");
}

try {
    // Consulta JOIN para obter todos os detalhes, incluindo nomes
    $sql = "SELECT 
                e.quantidade_atual, 
                e.estoque_minimo, 
                e.valor_venda, 
                e.deducao,
                m.partNumber,
                m.titulo, 
                m.caracteristica,
                m.obs AS modelo_obs,
                f.fornecedor AS fornecedor_nome, 
                f.cnpj AS fornecedor_cnpj,
                c.categoria AS categoria_nome,
                u.nome AS nome_cadastro
            FROM tb_estoque e
            JOIN tb_modelo m ON e.modelo = m.id
            JOIN tb_fornecedor f ON m.fornecedor = f.id
            JOIN tb_categoria c ON m.categoria = c.id
            JOIN tb_usuario u ON e.cadastrado_por = u.id
            WHERE e.id = :id";
            
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id_estoque]);
    $detalhes = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$detalhes) {
        die("Detalhes do estoque não encontrados.");
    }
} catch (PDOException $e) {
    die("Erro ao buscar detalhes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/estoque.css">
    <style>
        .details-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 30px auto;
        }
        .detail-item {
            display: flex;
            margin-bottom: 10px;
            border-bottom: 1px dashed #eee;
            padding-bottom: 5px;
        }
        .detail-label {
            font-weight: bold;
            color: #555;
            width: 180px;
        }
        .detail-value {
            flex-grow: 1;
        }
    </style>
    <title>Detalhes do Estoque</title>
</head>

<body>

    <header>
        <?php include "php/partes/menuInterno.php"; ?>
    </header>

    <main>
        <h2 id="tituloPagina">Detalhes do Item de Estoque (<?php echo htmlspecialchars($detalhes['titulo']); ?>)</h2>
        
        <div class="details-box">
            <h3>Dados do Modelo e Fornecedor</h3>
            <div class="detail-item"><div class="detail-label">Fornecedor:</div><div class="detail-value"><?php echo htmlspecialchars($detalhes['fornecedor_nome']); ?> (CNPJ: <?php echo htmlspecialchars($detalhes['fornecedor_cnpj']); ?>)</div></div>
            <div class="detail-item"><div class="detail-label">Categoria:</div><div class="detail-value"><?php echo htmlspecialchars($detalhes['categoria_nome']); ?></div></div>
            <div class="detail-item"><div class="detail-label">Código (Part Number):</div><div class="detail-value"><?php echo htmlspecialchars($detalhes['partNumber']); ?></div></div>
            <div class="detail-item"><div class="detail-label">Título:</div><div class="detail-value"><?php echo htmlspecialchars($detalhes['titulo']); ?></div></div>
            
            <hr style="margin: 20px 0;">

            <h3>Controle e Preços</h3>
            <div class="detail-item"><div class="detail-label">Quantidade Atual:</div><div class="detail-value"><?php echo htmlspecialchars($detalhes['quantidade_atual']); ?></div></div>
            <div class="detail-item"><div class="detail-label">Estoque Mínimo:</div><div class="detail-value"><?php echo htmlspecialchars($detalhes['estoque_minimo']); ?></div></div>
            <div class="detail-item"><div class="detail-label">Valor de Venda:</div><div class="detail-value">R$ <?php echo number_format($detalhes['valor_venda'], 2, ',', '.'); ?></div></div>
            <div class="detail-item"><div class="detail-label">Dedução (%):</div><div class="detail-value"><?php echo number_format($detalhes['deducao'], 2, ',', '.'); ?> %</div></div>
            
            <hr style="margin: 20px 0;">

            <h3>Informações Adicionais</h3>
            <div class="detail-item"><div class="detail-label">Característica do Modelo:</div><div class="detail-value"><?php echo nl2br(htmlspecialchars($detalhes['caracteristica'])); ?></div></div>
            <div class="detail-item"><div class="detail-label">Obs. do Modelo:</div><div class="detail-value"><?php echo nl2br(htmlspecialchars($detalhes['modelo_obs'])); ?></div></div>
            <div class="detail-item"><div class="detail-label">Cadastrado Por:</div><div class="detail-value"><?php echo htmlspecialchars($detalhes['nome_cadastro']); ?></div></div>

            <div style="text-align: center; margin-top: 30px;">
                <button class="btnCadastrar" onclick="window.location.href='estoque.php'">Voltar ao Estoque</button>
            </div>
        </div>
    </main>

    <footer>
        <?php include "php/partes/footerInterno.php"; ?>
    </footer>
</body>
</html>