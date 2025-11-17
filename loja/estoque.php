<?php
// estoque.php
include "php/partes/validaSession.php";
include "php/partes/conexao.php";
// Assumimos que $conn ou $pdo está definido em conexao.php
$db = isset($pdo) ? $pdo : $conn;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cadastro.css"> <link rel="stylesheet" href="css/estoque.css"> 
    <link rel="stylesheet" href="css/footerExterno.css">
    <title>Controle de Estoque</title>
</head>

<body>

    <header>
        <?php include "php/partes/menuInterno.php"; ?>
    </header>

    <main>
        <h2 id="tituloPagina">Lançamento de Estoque</h2>

       <form id="formEstoque" action="php/processaEstoque.php" method="POST">
    <input type="hidden" id="id" name="id" value="">

    <label>Modelo (Fornecedor / Código / Título):</label><br>
    <select name="cod_produto" id="cod_produto" required class="input">
        <option value="">Selecione o Modelo</option>
        <?php
            // Preenche o SELECT de MODELOS (com JOIN para exibir Fornecedor e Código)
            try {
                // Certifique-se de que $db está definido no topo do seu estoque.php
                $db = isset($pdo) ? $pdo : $conn;

                $sql = "SELECT 
                            m.id, 
                            m.partNumber, 
                            m.titulo, 
                            f.fornecedor AS fornecedor_nome
                        FROM tb_modelo m
                        JOIN tb_fornecedor f ON m.fornecedor = f.id
                        ORDER BY f.fornecedor, m.titulo ASC";
                $stmt = $db->query($sql);
                $modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($modelos) {
                    foreach ($modelos as $linha) {
                        $display = htmlspecialchars("{$linha['fornecedor_nome']} / {$linha['partNumber']} / {$linha['titulo']}");
                        echo "<option value='" . htmlspecialchars($linha['id']) . "'>{$display}</option>";
                    }
                } else {
                    echo "<option value=''>Nenhum modelo cadastrado</option>";
                }
            } catch (PDOException $e) {
                // Não exiba o erro diretamente ao usuário, apenas no log
                error_log("Erro ao carregar modelos: " . $e->getMessage());
                echo "<option value=''>Erro ao carregar modelos</option>";
            }
        ?>
    </select><br><br>

    <div class="form-row">
        <div class="form-group">
            <label>Quantidade Atual:</label><br>
            <input type="number" id="quantidade" name="quantidade" required class="input" min="0"><br><br>
        </div>
        
        <div class="form-group">
            <label>Estoque Mínimo:</label><br>
            <input type="number" id="estoque_minimo" name="estoque_minimo" required class="input" min="0"><br><br>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Valor de Venda (R$):</label><br>
            <input type="number" id="valor_venda" name="valor_venda" required class="input" step="0.01" min="0"><br><br>
        </div>

        <div class="form-group">
            <label>Dedução (%):</label><br>
            <input type="number" id="desconto" name="desconto" required class="input" step="0.01" min="0" max="100" value="0.00"><br><br>
        </div>
    </div>

    <button class="btnCadastrar" type="submit" id="btnSalvar">Lançar Estoque</button>
    <button type="button" class="btnCadastrar" id="btnCancelar" style="display:none;" onclick="limparFormulario()">Cancelar edição</button>
</form>
        
        <h2 style="margin-top: 30px;">Controle de Estoque</h2>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar por Modelo, Fornecedor ou Categoria..." class="search-input">
            <button id="searchButton" class="search-button"><i class="fas fa-search"></i></button>
            <button id="clearSearchButton" class="search-button" style="display:none;" onclick="clearSearch()"><i class="fas fa-times"></i></button>
        </div>
        
        <div id="listaEstoque" class="lista-estoque-container"></div>

    </main>

    <footer>
        <?php include "php/partes/footerInterno.php"; ?>
    </footer>

    <script>
    const $ = id => document.getElementById(id);
    const searchInput = $('searchInput');
    const searchButton = $('searchButton');
    const clearSearchButton = $('clearSearchButton');

    /* --- Funções do Formulário --- */
    function limparFormulario(){
        $('formEstoque').reset();
        $('id').value = '';
        $('btnSalvar').innerText = 'Lançar Estoque';
        $('btnCancelar').style.display = 'none';
        $('tituloPagina').innerText = 'Lançamento de Estoque';
    }

    $('formEstoque').addEventListener('submit', async function(e){
        e.preventDefault();
        try {
            const id = $('id').value;
            // Se houver ID, usa a URL de atualização. Se não, usa a de cadastro.
            const url = id ? 'php/atualizaEstoque.php' : 'php/processaEstoque.php';
            const formData = new FormData(this);
            
            // Adiciona o ID do usuário da sessão (se necessário, mas é melhor no PHP)
            // formData.append('usuario_id', <?php echo $_SESSION['id_usuario']; ?>); 

            const r = await fetch(url, { method: 'POST', body: formData });
            const text = await r.text(); 
            
            alert(text);
            limparFormulario();
            carregarEstoque();
        } catch (err) {
            console.error('Erro no envio do formulário:', err);
            alert('Erro no envio. Veja console.');
        }
    });

    /* --- Funções de Pesquisa (MANTIDAS) --- */
    searchButton.addEventListener('click', () => carregarEstoque(searchInput.value));
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            carregarEstoque(searchInput.value);
        }
    });

    function clearSearch() {
        searchInput.value = '';
        clearSearchButton.style.display = 'none';
        carregarEstoque();
    }

    /* --- Carregar Lista de Estoque (MANTIDA) --- */
    async function carregarEstoque(termoBusca = '') {
        const divLista = $('listaEstoque');
        divLista.innerHTML = '<p class="loading-message"><i class="fas fa-spinner fa-spin"></i> Carregando estoque...</p>';
        
        let url = 'js/listaEstoque.php';
        if (termoBusca) {
            url += '?busca=' + encodeURIComponent(termoBusca);
            clearSearchButton.style.display = 'inline-block';
        } else {
            clearSearchButton.style.display = 'none';
        }

        try {
            const r = await fetch(url);
            if (!r.ok) throw new Error(`Falha ao buscar estoque: ${r.status}`);
            const dados = await r.json();

            if (dados && dados.erro) {
                divLista.innerHTML = `<p class="error-message"><i class="fas fa-exclamation-triangle"></i> Erro: ${dados.erro}</p>`;
                return;
            }

            if (!Array.isArray(dados) || dados.length === 0) {
                divLista.innerHTML = `<p class="no-data-message">${termoBusca ? 'Nenhum item encontrado para sua busca.' : 'Nenhum item em estoque.'}</p>`;
                return;
            }

            let html = `<table class="estoque-table">
                <thead>
                    <tr>
                        <th>Modelo/Código</th>
                        <th>Fornecedor</th>
                        <th>Categoria</th>
                        <th>Estoque (Atual)</th>
                        <th>Estoque Mínimo</th>
                        <th>Valor Venda</th>
                        <th>Dedução</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>`;

            dados.forEach(it => {
                const isLowStock = parseInt(it.quantidade_atual) <= parseInt(it.estoque_minimo);
                
                html += `<tr class="${isLowStock ? 'low-stock' : ''}">
                    <td>${it.titulo} (${it.partNumber})</td>
                    <td>${it.fornecedor_nome}</td>
                    <td>${it.categoria_nome}</td>
                    <td>${it.quantidade_atual}</td>
                    <td>${it.estoque_minimo}</td>
                    <td>R$ ${parseFloat(it.valor_venda).toFixed(2).replace('.', ',')}</td>
                    <td>${parseFloat(it.deducao).toFixed(2).replace('.', ',')} %</td>
                    <td>
                        <button class="action-btn edit" onclick="editarEstoque(${it.id})"><i class="fas fa-edit"></i></button>
                        <button class="action-btn delete" onclick="excluirEstoque(${it.id})"><i class="fas fa-trash-alt"></i></button>
                        <button class="action-btn view-more" onclick="verDetalhes(${it.id})"><i class="fas fa-plus"></i></button>
                    </td>
                </tr>`;
            });

            html += `</tbody></table>`;
            divLista.innerHTML = html;

        } catch (err) {
            console.error(err);
            divLista.innerHTML = '<p class="error-message">Erro ao carregar lista de estoque. Tente novamente.</p>';
        }
    }

    /* --- Ações da Tabela --- */
    function editarEstoque(id) {
        // Redireciona para a nova página de edição
        window.location.href = `editarEstoque.php?id=${id}`;
    }

    function excluirEstoque(id) {
        if (!confirm('Tem certeza que deseja excluir este item de estoque?')) return;
        // Chama o endpoint de exclusão (js/excluirEstoque.php)
        fetch(`js/excluirEstoque.php?id=${id}`)
            .then(r => r.text())
            .then(text => {
                alert(text);
                carregarEstoque();
            })
            .catch(err => {
                console.error('Erro ao excluir:', err);
                alert('Erro ao excluir item. Veja console.');
            });
    }

    function verDetalhes(id) {
        // Redireciona para a nova página de detalhes
        window.location.href = `detalhesEstoque.php?id=${id}`;
    }

    /* --- Inicializa --- */
    document.addEventListener('DOMContentLoaded', carregarEstoque);
    document.addEventListener('DOMContentLoaded', function() {
        // Correção para usar o ID direto, caso o atalho '$' esteja causando problemas de escopo.
        const divLista = document.getElementById('listaEstoque'); 
        if (divLista) {
             carregarEstoque(); // Chama a função para carregar a lista ao iniciar
        } else {
             console.error("Elemento 'listaEstoque' não encontrado no DOM.");
        }
    });
    </script>
</body>
</html>