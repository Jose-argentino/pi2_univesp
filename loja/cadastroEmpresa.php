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
        <h2>Cadastro de Fornecedor</h2>

        <form id="form" action="php/processaCadastroEmpresa.php" method="POST">

            <label>Fornecedor:</label><br>
            <input type="text" name="fornecedor"  required><br><br>

            <label>Vendedor:</label><br>
            <input type="text" name="vendedor"  required><br><br>

            <label>CNPJ:</label><br>
            <input type="text" name="cnpj" maxlength="14" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" maxlength="50" required><br><br>

            <label>Telefone:</label><br>
            <input type="text" name="telefone" maxlength="20"><br><br>

            <label>Endereço:</label><br>
            <textarea name="endereco"></textarea><br><br>

            <label>Observações:</label><br>
            <textarea name="obs"></textarea><br><br>

            <label>Status:</label><br>
            <select name="statusEmpresa">
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