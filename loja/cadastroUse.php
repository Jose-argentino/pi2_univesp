<?php
    include "php/partes/validaSession.php";
    include "php/partes/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/geral.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/footerExterno.css">
</head>
<body>
    <header>
        <?php include "php/partes/menuInterno.php"; ?>
    </header>

    <main>
        <h2>Cadastro de Usuário</h2>

        <form id="form" action="php/processaCadastroUse.php" method="POST">
            <input type="hidden" id="id_usuario" name="id_usuario" value="">

            <label>Nome:</label>
            <input id="nome" type="text" name="nome" required>

            <label>Sobrenome:</label>
            <input id="sobreNome" type="text" name="sobreNome" required>

            <label>Senha:</label>
            <input id="senha" type="password" name="senha" placeholder="Deixe vazio para não alterar (edição)">

            <label>CPF:</label>
            <input id="cpf" type="text" name="cpf" maxlength="11" required>

            <label>Nível de Acesso:</label>
            <select id="nivel_acesso" name="nivel_acesso" required>
                <option value="">Selecione</option>
                <?php
                try {
                    $sql = "SELECT id, niv_acesso FROM tb_acesso ORDER BY niv_acesso ASC";
                    $stmt = $conn->query($sql);
                    $niveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($niveis as $linha) {
                        echo "<option value='".htmlspecialchars($linha['id'])."'>".htmlspecialchars($linha['niv_acesso'])."</option>";
                    }
                } catch (PDOException $e) {
                    echo "<option value=''>Erro ao carregar níveis</option>";
                }
                ?>
            </select>

            <label>Email:</label>
            <input id="email" type="email" name="email" maxlength="50" required>

            <label>Telefone:</label>
            <input id="telefone" type="text" name="telefone" maxlength="20">

            <label>Endereço:</label>
            <textarea id="endereco" name="endereco"></textarea>

            <label>Observações:</label>
            <textarea id="obs" name="obs"></textarea>

            <label>Status:</label>
            <select id="status_usuario" name="status_usuario">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>

            <div style="margin-top:12px;">
                <button class="btnCadastrar" type="submit" id="btnSalvar">Cadastrar</button>
                <button type="button" class="btnCadastrar" id="btnCancelarEdicao" style="display: none;" onclick="limparFormulario()">Cancelar Edição</button>
            </div>
        </form>

        <h2 style="margin-top:30px;">Lista de usuários</h2>
        <div id="carregarLista"></div>
    </main>

    <footer>
        <?php include "php/partes/footerInterno.php"; ?>
    </footer>

<script>
/* ---------- Funções utilitárias ---------- */
function __(id){ return document.getElementById(id); }

/* Limpa formulário e retorna ao modo cadastro */
function limparFormulario() {
    __('id_usuario').value = '';
    __('nome').value = '';
    __('sobreNome').value = '';
    __('senha').value = '';
    __('cpf').value = '';
    __('nivel_acesso').value = '';
    __('email').value = '';
    __('telefone').value = '';
    __('endereco').value = '';
    __('obs').value = '';
    __('status_usuario').value = '1';

    __('btnSalvar').innerText = 'Cadastrar';
    __('btnCancelarEdicao').style.display = 'none';
    document.querySelector('main h2').innerText = 'Cadastro de Usuário';
}

/* Carrega dados de um usuário para edição */
async function editarAcesso(id) {
    try {
        const resp = await fetch('php/getUse.php?id=' + id);
        const data = await resp.json();

        if (!data || !data.id_usuario) {
            alert('Erro ao carregar usuário.');
            return;
        }

        __('id_usuario').value = data.id_usuario;
        __('nome').value = data.nome;
        __('sobreNome').value = data.sobreNome;
        __('cpf').value = data.cpf;
        __('nivel_acesso').value = data.nivel_acesso;
        __('email').value = data.email;
        __('telefone').value = data.telefone;
        __('endereco').value = data.endereco;
        __('obs').value = data.obs;
        __('status_usuario').value = data.status_usuario;

        __('btnSalvar').innerText = 'Salvar Alterações';
        __('btnCancelarEdicao').style.display = 'inline-block';
        document.querySelector('main h2').innerText = 'Editando Usuário (ID: ' + data.id_usuario + ')';
        __('form').scrollIntoView({ behavior: 'smooth' });

    } catch (err) {
        console.error(err);
        alert('Erro ao carregar dados para edição.');
    }
}

/* EXCLUIR */
async function excluirAcesso(id) {
    if (!confirm('Tem certeza que deseja excluir este usuário?')) return;
    try {
        const resp = await fetch('php/excluirUse.php?id=' + id, { method: 'GET' });
        const json = await resp.json();
        if (json.sucesso) {
            alert(json.sucesso);
        } else {
            alert(json.erro || 'Erro ao excluir.');
        }
        carregarLista();
    } catch (err) {
        console.error(err);
        alert('Erro ao excluir usuário.');
    }
}

/* CARREGA LISTA */
async function carregarLista() {
    try {
        const resp = await fetch('php/listaUse.php');
        const lista = await resp.json();
        const div = __('carregarLista');
        div.innerHTML = '';

        if (!Array.isArray(lista) || lista.length === 0) {
            div.innerHTML = '<p>Nenhum usuário cadastrado.</p>';
            return;
        }

        let tabela = `
            <table border="1" cellpadding="8" cellspacing="0">
                <tr>
                    <th>Nome</th><th>Email</th><th>Nível</th><th>Status</th><th>Ações</th>
                </tr>
        `;

        lista.forEach(u => {
            tabela += `
                <tr>
                    <td>${u.nome} ${u.sobreNome}</td>
                    <td>${u.email}</td>
                    <td>${u.nivel_acesso}</td>
                    <td>${u.status_usuario == 1 ? 'Ativo' : 'Inativo'}</td>
                    <td>
                        <button onclick="editarAcesso(${u.id_usuario})">✏️ Editar</button>
                        <button onclick="excluirAcesso(${u.id_usuario})">🗑️ Excluir</button>
                    </td>
                </tr>
            `;
        });

        tabela += '</table>';
        div.innerHTML = tabela;

    } catch (err) {
        console.error('Erro ao carregar lista:', err);
        __('carregarLista').innerHTML = '<p>Erro ao carregar lista. Veja console.</p>';
    }
}

/* SUBMIT: cria ou atualiza via fetch */
__('form').addEventListener('submit', async function(e){
    e.preventDefault();

    const id_usuario = __('id_usuario').value;
    const destino = id_usuario ? 'php/atualizaUse.php' : 'php/processaCadastroUse.php';

    const formData = new FormData(this);

    try {
        const resp = await fetch(destino, {
            method: 'POST',
            body: formData
        });
        const text = await resp.text();
        // Os scripts PHP retornam mensagens com alert + redirect JS em alguns casos; aqui mostramos o retorno
        alert(text);
        limparFormulario();
        carregarLista();
    } catch (err) {
        console.error('Erro no envio:', err);
        alert('Erro ao processar formulário.');
    }
});

/* Ao carregar a página */
window.onload = function(){
    limparFormulario();
    carregarLista();
};
</script>
</body>
</html>
