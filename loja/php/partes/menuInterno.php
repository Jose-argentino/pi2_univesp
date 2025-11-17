<div id="logoPequena">
    <img class="logoPequenaImg" src="img/logo/logo_1.png" alt="">
</div>

<div id="nome">
    <h1>Nome da Loja</h1>
    <h4>P ao Plus Size</h4>
</div>

<div id="navBar">
    <i class="fas fa-bars menu-toggle"></i> <!-- Ícone hambúrguer -->
    <nav id="menu">
        <ul>
            <li><a href="home.php">Inicio</a></li>
            <li><a href="vendas.php">Vendas</a></li>
            <li><a href="#">Entradas</a></li>
            <li><a href="estoque.php">Estoque</a></li>
            <li><a href="cadastros.php">Cadastros</a></li>
            <li><a href="php/logout.php">Sair</a></li>


        </ul>
        <p>Bem-vindo, <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>!</p>

    </nav>
</div>
<!-- scripit para navBar -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const menu = document.querySelector("#menu");

    menuToggle.addEventListener("click", () => {
        menu.classList.toggle("active");
    });
});
</script>
