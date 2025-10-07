<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- Arquivo CSS externo -->
    <link rel="stylesheet" href="loja/css/geral.css">
    <link rel="stylesheet" href="loja/css/menu.css">
    <link rel="stylesheet" href="loja/css/index.css">
    <link rel="stylesheet" href="loja/css/footerExterno.css">
    <title>
        Bem vindo
    </title>

    <script>
        // Exibe mensagens de erro vindas pela URL (query string)
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const erro = urlParams.get("erro");
            if (erro) {
                document.getElementById("mensagem-erro").innerText = erro;
                document.getElementById("mensagem-erro").style.display = "block";
                alert(erro); // exibe uma caixa nativa do navegador com botão OK
            }
        };
    </script>

</head>

<body>
    <div id="container">
        <header>
           <?php 
                include "loja/php/partes/menuExternoIndex.php"
           ?>
        </header>

        <main>

            <div id="mensagem-erro"></div>

            
            <form action="loja/php/login_process.php" method="POST">
                <div class="form">

                    <!-- Campo de email -->
                    <input type="email" name="email" id="email" placeholder="Usuário" required>

                    <!-- Campo de senha -->
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>

                    <div class="buttons">
                        <!-- Botão de login -->
                        <button type="submit" class="entrar">Entrar</button>
                    </div>
                </div>
            </form> 


        </main>

        <footer>
            <?php
                include "loja/php/partes/footerExterno.php"
            ?>
        </footer>

    </div>
</body>
</html>