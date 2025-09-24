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
            <div id="logoPequena">
            <img class="logoPequenaImg" src="loja/img/logo/logo_1.jpg" alt="">
            </div>

            <div id="nome">
                <h1>Nome da Loja</h1>
                <h4>P ao Plus Size</h4>
            </div>

            <div id="navBarExterno">
                <a href="nova_senha.php">
                    <h4> 
                        <span>Redefinir</span>
                        <span>Senha</span>
                    </h4>
                </a>
            </div>
        </header>

        <main>

            <div id="mensagem-erro" style="display:none; color:red; font-weight:bold; margin:10px 0;"></div>

            
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

                    <!-- Link para recuperação de senha -->
                    <!-- <a href="nova_senha.php" class="recuperar-senha">Recuperar Senha</a> -->
                </div>
            </form> 


        </main>

        <footer>
            <div class="ContatosEmpresa">

                <!-- Ícones das redes sociais -->
                <div class="social-icons">
                    <a href="https://wa.me/5500000000000" target="_blank"><i class="fab fa-whatsapp"><span>Teste</span></i></a>
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"><span>Teste</span></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"><span>Teste</span></i></a>
                    <a href="mailto:contato@exemplo.com"><i class="fas fa-envelope"><span>Teste</span></i></a>
                </div>

                <!-- Informações de contato -->
                 <div>
                    <p><i class="fas fa-map-marker-alt"></i> Rua Exemplo, 123 - São Paulo, SP</p>
                    <p><i class="fas fa-envelope"></i> contato@exemplo.com</p>
                    <p><i class="fas fa-phone"></i> (11) 99999-9999</p>
                </div>

            </div>

            <p>&copy; 2025 - Minha Empresa</p>

        </footer>

    </div>
</body>
</html>