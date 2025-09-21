<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- Arquivo CSS externo -->
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>
</head>

<body>
    <div id="container">
        <?php
        var_dump()
        ?>
        <header>
            <div id="logoPequena">
            <img class="logoPequenaImg" src="img/logo/logo_1.jpg" alt="">
            </div>

            <div id="nome">
                <h1>Nome da Loja</h1>
                <h4>P ao Plus Size</h4>
            </div>

            <div id="navBar">
                <i class="fas fa-bars menu-toggle"></i> <!-- Ícone hambúrguer -->
                <nav id="menu">
                <ul>
                    <li><a href="#">Vendas</a></li>
                    <li><a href="#">Entradas</a></li>
                    <li><a href="#">Estoque</a></li>
                    <li><a href="#">Cadastro</a></li>
                </ul>
                </nav>
            </div>
            
        </header>

        <main>
         <h2>teste main</h2>   
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
            <h2>testes footer</h2>
        </footer>

    </div>
</body>
</html>