<?php
    include "php/partes/validaSession.php";
    include "php/partes/conexao.php";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- Arquivo CSS externo -->
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/footerExterno.css">
    <title>Cadastro de Empresas</title>
</head>

<body>

    <header>
        <?php 
            include "php/partes/menuInterno.php"
        ?>
    </header>

    <main>
        <h2>Cadastro de Modelo</h2>

        <form id="form" action="php/processaCadastroModelo.php" method="POST">

            <label>Fornecedor:</label><br>
            <select name="fornecedor" required>
                <option value="">Selecione</option>
                <?php
                    try {
                        $sql = "SELECT id, fornecedor FROM tb_fornecedor";
                        $stmt = $conn->query($sql);
                        $fornecedor = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($fornecedor) {
                            foreach ($fornecedor as $linha) {
                                echo "<option value='" . htmlspecialchars($linha['id']) . "'>" . htmlspecialchars($linha['fornecedor']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhum fornecedor encontrado</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Erro ao carregar os fornecedores</option>";
                    }
                ?>
            </select>

            <label>Categoria:</label><br>
            <select name="categoria" required>
                <option value="">Selecione</option>
                <?php
                    try {
                        $sql = "SELECT id, categoria FROM tb_categoria";
                        $stmt = $conn->query($sql);
                        $categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($categoria) {
                            foreach ($categoria as $linha) {
                                echo "<option value='" . htmlspecialchars($linha['id']) . "'>" . htmlspecialchars($linha['categoria']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhuma categoria encontrado</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Erro ao carregar as categoria</option>";
                    }
                ?>
            </select>

            <label>Código:</label><br>
            <input type="text" name="partNumber" required><br><br>


            <label>Titulo:</label><br>
            <input type="text" name="titulo"  required><br><br>

            <label>Caracteristica:</label><br>
            <textarea name="caracteristica"></textarea><br><br>

            <label>Observações:</label><br>
            <textarea name="obs"></textarea><br><br>

            <button class="btnCadastrar" type="submit">Cadastrar</button>
        </form>
    </main>

        <footer>
            <?php
                include "php/partes/footerInterno.php";
            ?>  
        </footer>
</body>
</html>