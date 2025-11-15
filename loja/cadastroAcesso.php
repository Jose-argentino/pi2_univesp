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
    <title>Cadastro de Nível de Acesso</title>
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

            <input type="hidden" name="id_acesso" id="id_acesso" value="">

            <label>Nivel do Acesso:</label><br>
            <input type="text" name="niv_acesso" id="niv_acesso" required><br><br>

            <label>Observações:</label><br>
            <textarea name="obs" id="obs"></textarea><br><br>

            <button class="btnCadastrar" type="submit" id="btnSalvar">Cadastrar</button>
            <button type="button" class="btnCadastrar" id="btnCancelarEdicao" style="display: none;" onclick="limparFormulario()">Cancelar Edição</button>
        </form>
        <hr>
        <h2>Lista de Níveis de Acesso</h2>
        <div id="listaLista"></div>

    </main>

    <footer>
        <?php
            include "php/partes/footerInterno.php";
        ?>  
    </footer>


    <script>
        
        async function carregarLista() {
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

        // Limpa o formulário e reverte o modo para 'Cadastro'
        function limparFormulario() {
            document.getElementById('id_acesso').value = '';
            document.getElementById('niv_acesso').value = '';
            document.getElementById('obs').value = '';
            document.getElementById('btnSalvar').innerText = 'Cadastrar';
            document.getElementById('btnCancelarEdicao').style.display = 'none';
            document.querySelector('main h2').innerText = 'Cadastro de Nivel de Acesso';
        }

        // Função para carregar os dados de um registro no formulário
        async function editarAcesso(id) {
            try {
                // Requisição para buscar um único registro 
                const resposta = await fetch('php/listaAcessoBuscar.php?id=' + id); 
                const acesso = await resposta.json();

                if (acesso && acesso.id) {
                    // 1. Preenche os campos do formulário
                    document.getElementById('id_acesso').value = acesso.id;
                    document.getElementById('niv_acesso').value = acesso.niv_acesso;
                    document.getElementById('obs').value = acesso.obs || '';

                    // 2. Altera o texto do botão para "Salvar Alterações"
                    document.getElementById('btnSalvar').innerText = 'Salvar Alterações';

                    // 3. Exibe o botão de cancelar edição
                    document.getElementById('btnCancelarEdicao').style.display = 'inline-block';
                    
                    // 4. Altera o título
                    document.querySelector('main h2').innerText = 'Editando Nivel de Acesso (ID: ' + acesso.id + ')';
                    
                    // 5. Rola para o formulário
                    document.getElementById('form').scrollIntoView({ behavior: 'smooth' });

                } else {
                    alert('Erro ao buscar dados do acesso.');
                }
            } catch (erro) {
                console.error('Erro ao carregar dados para edição:', erro);
                alert('Erro ao carregar dados para edição.');
            }
        }


        // --- Função de Envio do Formulário (Cadastro/Edição) - Intercepta o envio do formulário padrão para fazer a requisição via AJAX/Fetch
        document.getElementById('form').addEventListener('submit', async function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário (recarregar página)

            const formulario = event.target;
            const formData = new FormData(formulario);
            
            // Define qual arquivo PHP de processamento usar
            // Se id_acesso estiver preenchido, é EDIÇÃO. Caso contrário, é CADASTRO.
            const id_acesso = document.getElementById('id_acesso').value;
            const url_destino = id_acesso ? 'php/atualizaAcesso.php' : 'php/processaCadastroAcesso.php';

            try {
                const resposta = await fetch(url_destino, {
                    method: 'POST',
                    body: formData
                });

                const resultado = await resposta.text();
                alert(resultado); // Exibe a mensagem de sucesso ou erro do PHP

                // Após a ação, limpa o formulário e recarrega a lista
                limparFormulario(); 
                carregarAcessos();

            } catch (erro) {
                console.error('Erro ao processar formulário:', erro);
                alert('Erro ao tentar processar a operação.');
            }
        });


        

        // Funções de excluir 
        async function excluirAcesso(id) {
            if (confirm('Tem certeza que deseja excluir este acesso?')) {
                const resposta = await fetch('php/listaAcessoExcluir.php?id=' + id);
                const resultado = await resposta.text();
                alert(resultado);
                carregarAcessos(); // Recarrega a lista
            }
        }

        // Carrega a lista e limpa o formulário ao abrir a página
        window.onload = function() {
            limparFormulario();
            carregarAcessos();
        };
    </script>
</body>
</html>