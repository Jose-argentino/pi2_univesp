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

        <main class="produtos-container">
            <h2 class="titulo-secao">Produtos à Venda</h2>

            <div class="produtos-grid">

                <!-- Produto 1 -->
                <div class="produto-card">
                    <img src="img/produto/p01.jpg" alt="Produto 1" class="produto-img">

                    <h3 class="produto-titulo">Nome do Produto</h3>

                    <p class="produto-preco">R$ 99,90</p>

                    <div class="produto-botoes">
                        <a href="#" class="btn-comprar">Comprar</a>
                        <a href="#" class="btn-saibamais">Saiba Mais</a>
                    </div>
                </div>

                <!-- Produto 2 -->
                <div class="produto-card">
                    <img src="img/produto/p02.jpeg" alt="Produto 2" class="produto-img">

                    <h3 class="produto-titulo">Outro Produto</h3>

                    <p class="produto-preco">R$ 149,90</p>

                    <div class="produto-botoes">
                        <a href="#" class="btn-comprar">Comprar</a>
                        <a href="#" class="btn-saibamais">Saiba Mais</a>
                    </div>
                </div>

                <!-- Produto 1 -->
                <div class="produto-card">
                    <img src="img/produto/p01.jpg" alt="Produto 1" class="produto-img">

                    <h3 class="produto-titulo">Nome do Produto</h3>

                    <p class="produto-preco">R$ 99,90</p>

                    <div class="produto-botoes">
                        <a href="#" class="btn-comprar">Comprar</a>
                        <a href="#" class="btn-saibamais">Saiba Mais</a>
                    </div>
                </div>

                <!-- Produto 2 -->
                <div class="produto-card">
                    <img src="img/produto/p02.jpeg" alt="Produto 2" class="produto-img">

                    <h3 class="produto-titulo">Outro Produto</h3>

                    <p class="produto-preco">R$ 149,90</p>

                    <div class="produto-botoes">
                        <a href="#" class="btn-comprar">Comprar</a>
                        <a href="#" class="btn-saibamais">Saiba Mais</a>
                    </div>
                </div>

                <!-- Produto 1 -->
                <div class="produto-card">
                    <img src="img/produto/p01.jpg" alt="Produto 1" class="produto-img">

                    <h3 class="produto-titulo">Nome do Produto</h3>

                    <p class="produto-preco">R$ 99,90</p>

                    <div class="produto-botoes">
                        <a href="#" class="btn-comprar">Comprar</a>
                        <a href="#" class="btn-saibamais">Saiba Mais</a>
                    </div>
                </div>

                <!-- Produto 2 -->
                <div class="produto-card">
                    <img src="img/produto/p02.jpeg" alt="Produto 2" class="produto-img">

                    <h3 class="produto-titulo">Outro Produto</h3>

                    <p class="produto-preco">R$ 149,90</p>

                    <div class="produto-botoes">
                        <a href="#" class="btn-comprar">Comprar</a>
                        <a href="#" class="btn-saibamais">Saiba Mais</a>
                    </div>
                </div>

            </div>
 
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