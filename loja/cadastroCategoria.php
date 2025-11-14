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
        <h2>Cadastro de Categoria</h2>

        <form id="form" action="php/processaCadastroCategoria.php" method="POST">

            <label>Categoria</label><br>
            <input type="text" name="categoria" required><br><br>

            <label>Observações:</label><br>
            <textarea name="obs"></textarea><br><br>

            <button class="btnCadastrar" type="submit">Cadastrar</button>
        </form>

        <hr>
        <h2>Lista de Categorias</h2>
        <div id="listaCategorias"></div>

    </main>

    <footer>
        <?php
            include "php/partes/footerInterno.php";
        ?>  
    </footer>

    <script>
    //Funções de Listagem
        
        async function listaCategorias() {
            try {
                const resposta = await fetch('js/listaAcesso.php');
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
                            <th class="textoGrande">Observações</th>
                            <th>Ações</th>
                        </tr>
                `;

                // Percorre os registros e monta as linhas
                acessos.forEach(acesso => {
                    tabela += `
                        <tr>
                            <td>${acesso.niv_acesso}</td>
                            <td class="textoGrande">${acesso.obs || ''}</td>
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
                // ...
            }
        }    
    </script>
</body>
</html>