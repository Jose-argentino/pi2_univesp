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
    <link rel="stylesheet" href="css/lista.css">
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

        <form id="form">

    <input type="hidden" id="id_categoria" name="id">

    <label>Categoria</label><br>
    <input type="text" id="categoria" name="categoria" required><br><br>

    <label>Observações:</label><br>
    <textarea id="obs" name="obs"></textarea><br><br>

    <button type="submit" class="btnCadastrar" id="btnSalvar">Cadastrar</button>

    <button type="button" class="btnCadastrar" id="btnCancelarEdicao" onclick="limparFormulario()" style="display:none;">
        Cancelar
    </button>

</form>


        
        <h2>Lista de Categorias</h2>
        <div id="carregarLista"></div>

    </main>

    <footer>
        <?php
            include "php/partes/footerInterno.php";
        ?>  
    </footer>

    <script>
        //LIMPAR FORMULÁRIO
        function limparFormulario() {
            document.getElementById('id_categoria').value = '';
            document.getElementById('categoria').value = '';
            document.getElementById('obs').value = '';
            document.getElementById('btnSalvar').innerText = 'Cadastrar';
            document.getElementById('btnCancelarEdicao').style.display = 'none';
            document.querySelector('main h2').innerText = 'Cadastro de Categoria';
        }

        // EDITAR CATEGORIA 
        async function editarCategoria(id) {
            try {
                const resposta = await fetch('js/listaCategoriaBuscar.php?id=' + id);
                const categoria = await resposta.json();

                if (categoria && categoria.id) {

                    document.getElementById('id_categoria').value = categoria.id;
                    document.getElementById('categoria').value = categoria.categoria;
                    document.getElementById('obs').value = categoria.obs || '';

                    document.getElementById('btnSalvar').innerText = 'Salvar Alterações';
                    document.getElementById('btnCancelarEdicao').style.display = 'inline-block';
                    document.querySelector('main h2').innerText = 'Editando Categoria (ID: ' + categoria.id + ')';

                    document.getElementById('form').scrollIntoView({ behavior: 'smooth' });

                } else {
                    alert('Erro ao buscar dados da categoria.');
                }
            } catch (erro) {
                console.error('Erro ao carregar dados:', erro);
                alert('Erro ao carregar dados.');
            }
        }

        //  SUBMIT DO FORMULÁRIO
        document.getElementById('form').addEventListener('submit', async function(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const id_categoria = document.getElementById('id_categoria').value;

            const url = id_categoria
                ? 'php/atualizaCategoria.php'
                : 'php/processaCadastroCategoria.php';

            try {
                const resposta = await fetch(url, {
                    method: 'POST',
                    body: formData
                });

                const resultado = await resposta.text();
                alert(resultado);

                limparFormulario();
                carregarLista();

            } catch (erro) {
                console.error('Erro ao processar formulário:', erro);
                alert('Erro ao tentar processar a operação.');
            }
        });

        // EXCLUIR
        async function excluirCategoria(id) {
            if (confirm('Tem certeza que deseja excluir esta categoria?')) {
                try {
                    const resposta = await fetch('js/listaCategoriaExcluir.php?id=' + id);
                    const resultado = await resposta.json();

                    if (resultado.sucesso) {
                        alert(resultado.sucesso);
                    } else {
                        alert(resultado.erro || 'Erro desconhecido ao excluir.');
                    }

                    carregarLista();

                } catch (erro) {
                    console.error('Erro na exclusão:', erro);
                    alert('Erro ao excluir categoria.');
                }
            }
        }

        //  CARREGAR LISTA
        async function carregarLista() {
            try {
                const resposta = await fetch('js/listaCategoria.php');
                const categorias = await resposta.json();

                const divLista = document.getElementById('carregarLista');
                divLista.innerHTML = '';

                if (categorias.length === 0) {
                    divLista.innerHTML = '<p>Nenhuma categoria cadastrada.</p>';
                    return;
                }

                let tabela = `
                    <table border="1" cellpadding="8" cellspacing="0">
                        <tr>
                            <th>Categoria</th>
                            <th class="textoGrande">Observações</th>
                            <th>Ações</th>
                        </tr>
                `;

                categorias.forEach(cat => {
                    tabela += `
                        <tr>
                            <td>${cat.categoria}</td>
                            <td class="textoGrande">${cat.obs || ''}</td>
                            <td>
                                <button onclick="editarCategoria(${cat.id})">✏️ Editar</button>
                                <button onclick="excluirCategoria(${cat.id})">🗑️ Excluir</button>
                            </td>
                        </tr>
                    `;
                });

                tabela += '</table>';
                divLista.innerHTML = tabela;

            } catch (erro) {
                console.error('Erro ao carregar lista:', erro);
            }
        }

        //  AO ABRIR A PÁGINA 
        window.onload = function() {
            limparFormulario();
            carregarLista();
        };
    </script>

</body>
</html>