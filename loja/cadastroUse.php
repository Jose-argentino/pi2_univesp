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
    <link rel="stylesheet" href="css/cadastroUse.css">
    <link rel="stylesheet" href="css/footerExterno.css">
    <title>Cadastro de Usuário</title>
</head>

<body>

    <header>
        <?php 
            include "php/partes/menuInterno.php"
        ?>
    </header>

    <main>
        <h2>Cadastro de Usuário</h2>

        <form id="form" action="php/processa_cadastro.php" method="POST">
            <label>Nome:</label><br>
            <input type="text" name="nome"  required><br><br>

            <label>Senha:</label><br>
            <input type="password" name="senha"  required><br><br>

            <label>CPF:</label><br>
            <input type="text" name="cpf" maxlength="20" required><br><br>

            <label>Nível de Acesso:</label><br>
            <select name="nivel_acesso" required>
                <option value="">Selecione um nível</option>
                <?php
                    // Consulta para buscar os níveis de acesso disponíveis
                    $sql = "SELECT id, niv_acesso FROM tb_acesso";
                    $resultado = $conn->query($sql);

                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            echo "<option value='" . $linha['id'] . "'>" . htmlspecialchars($linha['niv_acesso']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum nível encontrado</option>";
                    }
                ?>
            </select>

            <label>Email:</label><br>
            <input type="email" name="email" maxlength="50" required><br><br>

            <label>Telefone:</label><br>
            <input type="text" name="telefone" maxlength="12"><br><br>

            <label>Endereço:</label><br>
            <textarea name="endereco"></textarea><br><br>

            <label>Observações:</label><br>
            <textarea name="obs"></textarea><br><br>

            <label>Status:</label><br>
            <select name="status_usuario">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select><br><br>

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
