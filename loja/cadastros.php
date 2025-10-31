<?php
    include "php/partes/validaSession.php";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- Arquivo CSS externo -->
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cadastros.css">
    <link rel="stylesheet" href="css/footerExterno.css">
    <title>Cadastros</title>
</head>

<body>
    <div id="container">

        <header>
            <?php 
                include "php/partes/menuInterno.php"
            ?>
        </header>

        <main>
            <div class="cadrasto">
                <a href="cadastroUse.php"><button class="btnLink">Usuário</button></a>
                <a href="cadastroEmpresa.php"><button class="btnLink">Fornecedor</button></a>
                <a href="cadastroModelo.php"><button class="btnLink">Modelo</button></a>
                <a href=""><button class="btnLink">Estoque</button></a>
                <a href="cadastroCategoria.php"><button class="btnLink">Categoria</button></a>
                <a href="cadastroAcesso.php"><button class="btnLink">Acesso</button></a>

            </div>

        </main>

        <footer>
            <?php
                include "php/partes/footerInterno.php";
            ?>
        </footer>

    </div>
</body>
</html>  