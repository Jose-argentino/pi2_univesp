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
    <link rel="stylesheet" href="css/cadastro_use.css">
    <link rel="stylesheet" href="css/footerExterno.css">
    <title>Cadastro de Usuário</title>
</head>

<body>
    <div id="container">

        <header>
            <?php 
                include "php/partes/menuInterno.php"
            ?>

        </header>

        <main>
            <h2>Cadastros</h2>
        </main>

        <footer>
            <?php
                include "php/partes/footerInterno.php";
            ?>
        </footer>

    </div>
</body>
</html>  