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

        <form id="form" action="php/processaCadastroAcesso.php" method="POST">

            <label>Nivel do Acesso:</label><br>
            <input type="text" name="niv_acesso" required><br><br>


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