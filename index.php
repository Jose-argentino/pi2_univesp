<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- Arquivo CSS externo -->
    <link rel="stylesheet" href="loja/css/geral.css">
    <link rel="stylesheet" href="loja/css/menu.css">
    <link rel="stylesheet" href="loja/css/index.css">
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
            }
        };
    </script>

</head>

<body>
    <div id="container">
        <header>
            <div id="logoPequena">
            <img class="logoPequenaImg" src="loja/img/logo/logo_1.jpg" alt="">
            </div>

            <div id="nome">
                <h1>Nome da Loja</h1>
                <h4>P ao Plus Size</h4>
            </div>

            <div id="navBarExterno">
                <a href="nova_senha.html">
                    <h4> 
                        <span>Redefinir</span>
                        <span>Senha</span>
                    </h4>
                </a>
            </div>
        </header>

        <main>

                <!-- Formulário de login -->
            <!-- Envia para backend/login_process.php -->
            <form action="loja/php/login_process.php" method="POST">
                <div class="form">

                    <!-- Campo de email -->
                    <input type="text" name="email" id="email" placeholder="Usuário" required>

                    <!-- Campo de senha -->
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>

                    <!-- Área onde será exibida a mensagem de erro -->
                    <p id="mensagem-erro" class="erro" style="display:none;"></p>

                    <div class="buttons">
                        <!-- Botão de login -->
                        <button type="submit" class="entrar">Entrar</button>
                    </div>

                    <!-- Link para recuperação de senha -->
                    <a href="recuperar.php" class="recuperar-senha">Recuperar Senha</a>
                </div>
    </form> 


        </main>

        <footer>
            <h2>testes footer</h2>
        </footer>

    </div>
</body>
</html>