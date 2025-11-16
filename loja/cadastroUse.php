<?php
    include "php/partes/validaSession.php";
    include "php/partes/conexao.php";
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
    <link rel="stylesheet" href="css/footerExterno.css">
    <title>Cadastro de Usuário</title>
</head>

<body>

    <header>
        <?php include "php/partes/menuInterno.php"; ?>
    </header>

    <main>
        <h2>Cadastro de Usuário</h2>

        <form id="form" action="php/processaCadastroUse.php" method="POST">

            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Sobrenome:</label>
            <input type="text" name="sobreNome" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <label>CPF:</label>
            <input type="text" name="cpf" maxlength="11" required>

            <label>Nível de Acesso:</label>
            <select name="nivel_acesso" required>
                <option value="">Selecione</option>
                <?php
                    try {
                        $sql = "SELECT id, niv_acesso FROM tb_acesso ORDER BY niv_acesso ASC";
                        $stmt = $conn->query($sql);
                        $niveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($niveis) {
                            foreach ($niveis as $linha) {
                                echo "<option value='{$linha['id']}'>" . htmlspecialchars($linha['niv_acesso']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhum nível encontrado</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Erro ao carregar níveis</option>";
                    }
                ?>
            </select>

            <label>Email:</label>
            <input type="email" name="email" maxlength="50" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" maxlength="20">

            <label>Endereço:</label>
            <textarea name="endereco"></textarea>

            <label>Observações:</label>
            <textarea name="obs"></textarea>

            <label>Status:</label>
            <select name="status_usuario">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>

            <button class="btnCadastrar" type="submit">Cadastrar</button>
        </form>

        <h2>Lista de usuarios</h2>
        <div id="carregarLista"></div>

    </main>

    <footer>
        <?php include "php/partes/footerInterno.php"; ?>  
    </footer>


</body>
</html>
