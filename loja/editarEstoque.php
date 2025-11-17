<?php
// editarEstoque.php
include "php/partes/validaSession.php";
include "php/partes/conexao.php";
$db = isset($pdo) ? $pdo : $conn;

$id_estoque = $_GET['id'] ?? 0;
if (!$id_estoque) {
    die("ID de estoque não fornecido.");
}

// 1. Buscar dados do item de estoque
try {
    $stmt = $db->prepare("SELECT * FROM tb_estoque WHERE id = :id");
    $stmt->execute([':id' => $id_estoque]);
    $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$estoque) {
        die("Item de estoque não encontrado.");
    }
} catch (PDOException $e) {
    die("Erro ao buscar item: " . $e->getMessage());
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
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Editar Estoque</title>
</head>

<body>

    <header>
        <?php include "php/partes/menuInterno.php"; ?>
    </header>

    <main>
        <h2 id="tituloPagina">Editando Item de Estoque (ID: <?php echo $id_estoque; ?>)</h2>

        <form id="formEstoque" action="php/atualizaEstoque.php" method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($estoque['id']); ?>">

            <label>Modelo (Fornecedor / Código / Título):</label><br>
            <select name="modelo" id="modelo" required class="input">
                <option value="">Selecione o Modelo</option>
                <?php
                    // Preenche o SELECT de MODELOS
                    $sql_modelos = "SELECT m.id, m.partNumber, m.titulo, f.fornecedor AS fornecedor_nome FROM tb_modelo m JOIN tb_fornecedor f ON m.fornecedor = f.id ORDER BY f.fornecedor, m.titulo ASC";
                    $stmt_modelos = $db->query($sql_modelos);
                    $modelos = $stmt_modelos->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($modelos as $linha) {
                        $display = htmlspecialchars("{$linha['fornecedor_nome']} / {$linha['partNumber']} / {$linha['titulo']}");
                        $selected = ($linha['id'] == $estoque['modelo']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($linha['id']) . "' {$selected}>{$display}</option>";
                    }
                ?>
            </select><br><br>

            <div class="form-row">
                <div class="form-group">
                    <label>Quantidade Atual:</label><br>
                    <input type="number" id="quantidade_atual" name="quantidade_atual" required class="input" min="0" value="<?php echo htmlspecialchars($estoque['quantidade_atual']); ?>"><br><br>
                </div>
                
                <div class="form-group">
                    <label>Estoque Mínimo:</label><br>
                    <input type="number" id="estoque_minimo" name="estoque_minimo" required class="input" min="0" value="<?php echo htmlspecialchars($estoque['estoque_minimo']); ?>"><br><br>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Valor de Venda (R$):</label><br>
                    <input type="number" id="valor_venda" name="valor_venda" required class="input" step="0.01" min="0" value="<?php echo htmlspecialchars($estoque['valor_venda']); ?>"><br><br>
                </div>

                <div class="form-group">
                    <label>Dedução (%):</label><br>
                    <input type="number" id="deducao" name="deducao" required class="input" step="0.01" min="0" max="100" value="<?php echo htmlspecialchars($estoque['deducao']); ?>"><br><br>
                </div>
            </div>

            <button class="btnCadastrar" type="submit" id="btnSalvar">Salvar Alterações</button>
            <button type="button" class="btnCadastrar" onclick="window.location.href='estoque.php'">Voltar ao Estoque</button>
        </form>
    </main>

    <footer>
        <?php include "php/partes/footerInterno.php"; ?>
    </footer>
    
    <script>
        // Simplesmente submete o formulário, o script PHP fará a atualização e o alert.
        document.getElementById('formEstoque').addEventListener('submit', function(e){
            // Nenhuma lógica AJAX complexa, deixa o PHP fazer o redirecionamento ou mensagem.
        });
    </script>
</body>
</html>