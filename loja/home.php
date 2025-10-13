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
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/footerInterno.css">
    <title>
        Home
    </title>
</head>

<body>
    <div id="container">
        
    <header>
        <?php 
            include "php/partes/menuInterno.php"
        ?>
    </div>
        
    </header>

        <main>
         <h2>teste main da home</h2>   
        </main>

        <!-- java script -->
        <script>
            // Pega elementos
            const toggle = document.querySelector(".menu-toggle");
            const menu = document.getElementById("menu");

            // Abre/fecha menu ao clicar no ícone
            toggle.addEventListener("click", () => {
            menu.classList.toggle("active");
            });
        </script>

        <footer>
            <?php
                include "php/partes/footerInterno.php";
            ?>
        </footer>

    </div>
</body>
</html>