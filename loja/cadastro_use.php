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

    <header>
        <?php 
            include "php/partes/menuInterno.php"
        ?>

    </header>

    <main>
        <h2>Cadastro de Usuário</h2>
        <form action="php/processa_cadastro.php" method="POST">
            <label>Nome:</label><br>
            <input type="text" name="nome"  required><br><br>

            <label>Senha:</label><br>
            <input type="password" name="senha"  required><br><br>

            <label>CPF:</label><br>
            <input type="text" name="cpf" maxlength="20" required><br><br>

            <label>Nível de Acesso:</label><br>
            <input type="number" name="nivel_acesso" min="0" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" maxlength="50" required><br><br>

            <label>Telefone:</label><br>
            <input type="text" name="telefone" maxlength="12"><br><br>

            <label>Endereço:</label><br>
            <textarea name="endereco"></textarea><br><br>

            <label>Observações:</label><br>
            <textarea name="obs"></textarea><br><br>

            <label>Status:</label><br>
            <select name="status">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select><br><br>

            <label>Cadastrado por:</label><br>
            <input type="text" name="cadastrado_por" maxlength="50" required><br><br>

            <button type="submit">Cadastrar</button>
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
</body>
</html>
