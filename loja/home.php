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