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
    <title>Cadastro de Modelo</title>
</head>

<body>

    <header>
        <?php 
            include "php/partes/menuInterno.php"
        ?>
    </header>

    <main>
        <h2 id="tituloForm">Cadastro de Modelo</h2>

        <form id="formModelo" action="php/processaCadastroModelo.php" method="POST">
            <input type="hidden" id="id" name="id" value="">

            <label>Fornecedor:</label><br>
            <select name="fornecedor" id="fornecedor" required> <option value="">Selecione</option>
                <?php
                    // Sua lógica PHP para carregar fornecedores (mantida)
                    try {
                        $sql = "SELECT id, fornecedor FROM tb_fornecedor ORDER BY fornecedor ASC";
                        $stmt = $conn->query($sql);
                        $fornecedor = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($fornecedor) {
                            foreach ($fornecedor as $linha) {
                                echo "<option value='" . htmlspecialchars($linha['id']) . "'>" . htmlspecialchars($linha['fornecedor']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhum fornecedor encontrado</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Erro ao carregar os fornecedores</option>";
                    }
                ?>
            </select>

            <label>Categoria:</label><br>
            <select name="categoria" id="categoria" required> <option value="">Selecione</option>
                <?php
                    // Sua lógica PHP para carregar categorias (mantida)
                    try {
                        $sql = "SELECT id, categoria FROM tb_categoria ORDER BY categoria ASC";
                        $stmt = $conn->query($sql);
                        $categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($categoria) {
                            foreach ($categoria as $linha) {
                                echo "<option value='" . htmlspecialchars($linha['id']) . "'>" . htmlspecialchars($linha['categoria']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>Nenhuma categoria encontrado</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<option value=''>Erro ao carregar as categoria</option>";
                    }
                ?>
            </select>

            <label>Código:</label><br>
            <input type="text" name="partNumber" id="partNumber" required><br><br> <label>Titulo:</label><br>
            <input type="text" name="titulo" id="titulo" required><br><br> <label>Caracteristica:</label><br>
            <textarea name="caracteristica" id="caracteristica"></textarea><br><br> <label>Observações:</label><br>
            <textarea name="obs" id="obs"></textarea><br><br> <button class="btnCadastrar" type="submit" id="btnSalvar">Cadastrar</button>
            <button type="button" class="btnCadastrar" id="btnCancelar" style="display:none;" onclick="limparFormulario()">Cancelar edição</button>
        </form>
        
        <h2 style="margin-top: 30px;">Lista de Modelos</h2>
        <div id="carregarLista"></div> </main>

    <footer>
        <?php include "php/partes/footerInterno.php"; ?> 
    </footer>

    <script>
        // Função auxiliar
        const $ = id => document.getElementById(id);

        function limparFormulario(){
            $('formModelo').reset();
            $('id').value = '';
            $('btnSalvar').innerText = 'Cadastrar';
            $('btnCancelar').style.display = 'none';
            $('tituloForm').innerText = 'Cadastro de Modelo';
        }

        /* ----------------------------------- */
        /* --- Carregar lista de Modelos --- */
        /* ----------------------------------- */
        async function carregarLista(){
            try {
                // Endpoint para buscar a lista de modelos (Precisa ser criado)
                const r = await fetch('js/listaModelos.php');
                if (!r.ok) throw new Error('Falha ao buscar lista: ' + r.status);
                const dados = await r.json();

                const div = $('carregarLista');
                
                if (dados && dados.erro) {
                    div.innerHTML = `<p style="color: red;">Erro do Servidor: ${dados.erro}</p>`;
                    console.error('Erro PHP:', dados.erro);
                    return;
                }

                if (!Array.isArray(dados) || dados.length === 0) {
                    div.innerHTML = '<p>Nenhum modelo cadastrado.</p>';
                    return;
                }

                let html = `<table border="1" cellpadding="6" cellspacing="0">
                    <tr><th>Fornecedor</th><th>Categoria</th><th>Código</th><th>Título</th><th>Ações</th></tr>`;

                dados.forEach(it => {
                    // Assumimos que o endpoint listaModelos.php retorna o NOME do fornecedor (fornecedor_nome) e da categoria (categoria_nome)
                    html += `<tr>
                        <td>${it.fornecedor_nome || it.fornecedor}</td>
                        <td>${it.categoria_nome || it.categoria}</td>
                        <td>${it.partNumber}</td>
                        <td>${it.titulo}</td>
                        <td>
                            <button onclick="editarModelo(${it.id})">✏️</button>
                            <button onclick="excluirModelo(${it.id})">🗑️</button>
                        </td>
                    </tr>`;
                });

                html += `</table>`;
                div.innerHTML = html;

            } catch (err) {
                console.error(err);
                $('carregarLista').innerHTML = '<p style="color: red;">Erro ao carregar lista. Veja console do navegador.</p>';
            }
        }

        /* ----------------------------------- */
        /* --- Buscar um registro para editar --- */
        /* ----------------------------------- */
        async function editarModelo(id){
            try {
                // Endpoint para buscar o modelo específico (Precisa ser criado)
                const r = await fetch('js/buscaModelo.php?id=' + id);
                if (!r.ok) throw new Error('Erro ao buscar modelo: ' + r.status);
                const d = await r.json();
                
                if (d && d.erro) { alert('Erro do Servidor ao buscar registro: ' + d.erro); return; }
                if (!d || !d.id) { alert('Registro não encontrado'); return; }

                // Preenche os campos do formulário
                $('id').value = d.id;
                $('fornecedor').value = d.fornecedor; // O SELECT precisa do ID do fornecedor
                $('categoria').value = d.categoria;   // O SELECT precisa do ID da categoria
                $('partNumber').value = d.partNumber;
                $('titulo').value = d.titulo;
                $('caracteristica').value = d.caracteristica;
                $('obs').value = d.obs;

                $('btnSalvar').innerText = 'Salvar Alterações';
                $('btnCancelar').style.display = 'inline-block';
                $('tituloForm').innerText = 'Editando Modelo: ' + d.partNumber;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } catch (err) {
                console.error(err);
                alert('Erro ao carregar dados para edição. Veja console.');
            }
        }

        /* ----------------------------------- */
        /* --- Envio do formulário (Cadastrar/Atualizar) --- */
        /* ----------------------------------- */
        $('formModelo').addEventListener('submit', async function(e){
            e.preventDefault();
            try {
                const id = $('id').value;
                // Se houver ID, usa a URL de atualização. Se não, usa a de cadastro.
                const url = id ? 'php/atualizaModelo.php' : 'php/processaCadastroModelo.php';
                const formData = new FormData(this);
                const r = await fetch(url, { method: 'POST', body: formData });
                
                // Leitura da resposta como texto
                const text = await r.text(); 
                
                alert(text);
                limparFormulario();
                carregarLista();
            } catch (err) {
                console.error(err);
                alert('Erro no envio. Veja console.');
            }
        });

        /* ----------------------------------- */
        /* --- Excluir --- */
        /* ----------------------------------- */
        async function excluirModelo(id){
            if (!confirm('Deseja excluir este modelo?')) return;
            try {
                // Endpoint para exclusão (Precisa ser criado)
                const r = await fetch('js/excluirModelo.php?id=' + id); 
                const text = await r.text();
                alert(text);
                carregarLista();
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
            carregarLista();
        });
    </script>
</body>
</html>