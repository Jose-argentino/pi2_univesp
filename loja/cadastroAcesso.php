<?php
    include "php/partes/validaSession.php";
    include "php/partes/conexao.php";
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><!-- Arquivo CSS externo -->
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/footerExterno.css">
    <title>Cadastro de Empresas</title>
</head>

<body>

    <header>
        <?php 
            include "php/partes/menuInterno.php"
        ?>
    </header>

    <main>

        <h2>Cadastro de Nivel de Acesso</h2>

        <form id="form" action="php/processaCadastroAcesso.php" method="POST">

            <label>Nivel do Acesso:</label><br>
            <input type="text" name="niv_acesso" required><br><br>

            <label>Observações:</label><br>
            <textarea name="obs"></textarea><br><br>

            <button class="btnCadastrar" type="submit">Cadastrar</button>
        </form>

        <hr>
        <h3>Lista de Níveis de Acesso</h3>
        <div id="listaAcessos"></div>

    </main>

    <footer>
        <?php
            include "php/partes/footerInterno.php";
        ?>  
    </footer>



    <script>
    // Função para buscar e exibir os níveis de acesso
    async function carregarAcessos() {
        try {
            const resposta = await fetch('php/listaAcesso.php');
            const acessos = await resposta.json();

            const divLista = document.getElementById('listaAcessos');
            divLista.innerHTML = '';

            if (acessos.length === 0) {
                divLista.innerHTML = '<p>Nenhum nível de acesso cadastrado.</p>';
                return;
            }

            // Cria uma tabela
            let tabela = `
                <table border="1" cellpadding="8" cellspacing="0">
                    <tr>
                        <th>Nível de Acesso</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
            `;

            // Percorre os registros e monta as linhas
            acessos.forEach(acesso => {
                tabela += `
                    <tr>
                        <td>${acesso.niv_acesso}</td>
                        <td>${acesso.obs || ''}</td>
                        <td>
                            <button onclick="editarAcesso(${acesso.id})">✏️ Editar</button>
                            <button onclick="excluirAcesso(${acesso.id})">🗑️ Excluir</button>
                        </td>
                    </tr>
                `;
            });

            tabela += '</table>';
            divLista.innerHTML = tabela;

        } catch (erro) {
            console.error('Erro ao carregar acessos:', erro);
        }
    }

    // Funções de editar
    function editarAcesso(id) {
        window.location.href = 'php/listaAcessoEditar.php?id=' + id;
    }

    // Funções de excluir 
    async function excluirAcesso(id) {
        if (confirm('Tem certeza que deseja excluir este acesso?')) {
            const resposta = await fetch('php/listaAcessoExcluir.php?id=' + id);
            const resultado = await resposta.text();
            alert(resultado);
            carregarAcessos(); // Recarrega a lista
        }
    }

    // Carrega a lista ao abrir a página
    window.onload = carregarAcessos;
    </script>

</body>
</html>