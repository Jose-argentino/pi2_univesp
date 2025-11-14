<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- Arquivo CSS externo -->
    <link rel="stylesheet" href="loja/css/geral.css">
    <link rel="stylesheet" href="loja/css/menu.css">
    <link rel="stylesheet" href="loja/css/nova_senha.css">
    <link rel="stylesheet" href="loja/css/footerExterno.css">

    <title>Recuperar Senha</title>
</head>

<body>
    <div id="container">
        <header>
           <?php 
                include "loja/php/partes/menuExternoNovaSenha.php"
           ?>
        </header>

        <main>
            <form action="loja/php/enviarEmailRecuperacao.php" method="POST" class="form-recuperar">
                <div class="form">

                    <label for="email">Digite seu e-mail cadastrado:</label>

                    <input type="email" id="email" name="email" required placeholder="exemplo@email.com">
                    
                    <div class="buttons">
                        <button type="submit">Recuper</button>
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