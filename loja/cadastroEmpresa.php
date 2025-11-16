<?php
    include "php/partes/validaSession.php";
    include "php/partes/conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/footerExterno.css">
    <title>Cadastro de Empresas</title>
</head>

<body>

    <header>
        <?php include "php/partes/menuInterno.php"; ?>
    </header>

    <main>
        <h2 id="tituloForm">Cadastro de Fornecedor</h2>

        <form id="formEmpresa" action="php/processaCadastroEmpresa.php" method="POST">

            <input type="hidden" id="id" name="id" value="">

            <label>Fornecedor:</label><br>
            <input type="text" id="fornecedor" name="fornecedor" required class="input"><br><br>

            <label>Vendedor:</label><br>
            <input type="text" id="vendedor" name="vendedor" required class="input"><br><br>

            <label>CNPJ:</label><br>
            <input type="text" id="cnpj" name="cnpj" required class="input"><br><br>

            <label>Email:</label><br>
            <input type="email" id="email" name="email" maxlength="50" required class="input"><br><br>

            <label>Telefone:</label><br>
            <input type="text" id="telefone" name="telefone" maxlength="20" class="input"><br><br>

            <label>Endereço:</label><br>
            <textarea id="endereco" name="endereco" class="textarea"></textarea><br><br>

            <label>Observações:</label><br>
            <textarea id="obs" name="obs" class="textarea"></textarea><br><br>

            <button class="btnCadastrar" type="submit" id="btnSalvar">Cadastrar</button>
            <button type="button" class="btnCadastrar" id="btnCancelar" style="display:none;" onclick="limparFormulario()">Cancelar edição</button>
        </form>

        <h2>Lista de Fornecedores</h2>
        <div id="carregarLista"></div>
        
    </main>

    <footer>
        <?php include "php/partes/footerInterno.php"; ?>
    </footer>


    <script>

    // Função auxiliar (abreviada)
    const $ = id => document.getElementById(id);

    function limparFormulario(){
        $('formEmpresa').reset();
        $('id').value = '';
        $('btnSalvar').innerText = 'Cadastrar';
        $('btnCancelar').style.display = 'none';
        $('tituloForm').innerText = 'Cadastro de Fornecedor';
    }

    /* ----------------------------------- */
    /* --- Carregar lista de Fornecedores --- */
    /* ----------------------------------- */
    // NOME DA FUNÇÃO CORRIGIDO: de caregarLista para carregarLista
    async function carregarLista(){
        try {
            // CONFIRME se o nome do arquivo PHP está correto:
            const r = await fetch('js/listaEmpresas.php');
            if (!r.ok) throw new Error('Falha ao buscar lista: ' + r.status);
            const dados = await r.json();

            // ID CORRIGIDO: buscando o div com o ID 'carregarLista'
            const div = $('carregarLista');
            
            // Tratamento de Erro do PHP (se retornar JSON com erro)
            if (dados && dados.erro) {
                div.innerHTML = `<p style="color: red;">Erro do Servidor: ${dados.erro}</p>`;
                console.error('Erro PHP:', dados.erro);
                return;
            }

            if (!Array.isArray(dados) || dados.length === 0) {
                div.innerHTML = '<p>Nenhum fornecedor cadastrado.</p>';
                return;
            }

            let html = `<table border="1" cellpadding="6" cellspacing="0">
                <tr><th>Fornecedor</th><th>Vendedor</th><th>CNPJ</th><th>Email</th><th>Ações</th></tr>`;

            dados.forEach(it => {
                html += `<tr>
                    <td>${it.fornecedor}</td>
                    <td>${it.vendedor}</td>
                    <td>${it.cnpj}</td>
                    <td>${it.email}</td>
                    <td>
                        <button onclick="editarEmpresa(${it.id})">✏️</button>
                        <button onclick="excluirEmpresa(${it.id})">🗑️</button>
                    </td>
                </tr>`;
            });

            html += `</table>`;
            div.innerHTML = html;

        } catch (err) {
            console.error(err);
            // ID CORRIGIDO: buscando o div com o ID 'carregarLista'
            $('carregarLista').innerHTML = '<p style="color: red;">Erro ao carregar lista. Veja console do navegador.</p>';
        }
    }

    /* ----------------------------------- */
    /* --- Buscar um registro para editar --- */
    /* ----------------------------------- */
    async function editarEmpresa(id){
        try {
            const r = await fetch('js/buscaEmpresa.php?id=' + id);
            if (!r.ok) throw new Error('Erro ao buscar empresa: ' + r.status);
            const d = await r.json();
            
            // Tratamento de Erro do PHP
            if (d && d.erro) { alert('Erro do Servidor ao buscar registro: ' + d.erro); return; }
            if (!d || !d.id) { alert('Registro não encontrado'); return; }

            $('id').value = d.id;
            $('fornecedor').value = d.fornecedor;
            $('vendedor').value = d.vendedor;
            $('cnpj').value = d.cnpj;
            $('email').value = d.email;
            $('telefone').value = d.telefone;
            $('endereco').value = d.endereco;
            $('obs').value = d.obs;

            $('btnSalvar').innerText = 'Salvar Alterações';
            $('btnCancelar').style.display = 'inline-block';
            $('tituloForm').innerText = 'Editando: ' + d.fornecedor;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } catch (err) {
            console.error(err);
            alert('Erro ao carregar dados para edição. Veja console.');
        }
    }

    /* ----------------------------------- */
    /* --- Envio do formulário (Cadastrar/Atualizar) --- */
    /* ----------------------------------- */
    $('formEmpresa').addEventListener('submit', async function(e){
        e.preventDefault();
        try {
            const id = $('id').value;
            const url = id ? 'php/atualizaEmpresa.php' : 'php/processaCadastroEmpresa.php';
            const formData = new FormData(this);
            const r = await fetch(url, { method: 'POST', body: formData });
            
            // Sempre leia a resposta como texto, pois os endpoints de processamento/atualização/exclusão 
            // frequentemente retornam mensagens de sucesso em texto simples.
            const text = await r.text(); 
            
            alert(text);
            limparFormulario();
            carregarLista(); // Chamada corrigida
        } catch (err) {
            console.error(err);
            alert('Erro no envio. Veja console.');
        }
    });

    /* ----------------------------------- */
    /* --- Excluir --- */
    /* ----------------------------------- */
    async function excluirEmpresa(id){
        if (!confirm('Deseja excluir este fornecedor?')) return;
        try {
            // CONFIRME se o nome do arquivo PHP está correto:
            const r = await fetch('js/excluirEmpresa.php?id=' + id); 
            const text = await r.text();
            alert(text);
            carregarLista(); // Chamada corrigida
        } catch (err) {
            console.error(err);
            alert('Erro ao excluir. Veja console.');
        }
    }

    /* ----------------------------------- */
    /* --- Inicializa --- */
    /* ----------------------------------- */
    document.addEventListener('DOMContentLoaded', function(){
        limparFormulario();
        carregarLista(); // Chamada corrigida
    });
    </script>

</body>
</html>