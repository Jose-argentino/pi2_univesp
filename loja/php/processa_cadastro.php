<?php

    // Inclui conexão com banco de dados
    include "conexao.php";

    try {
        // Cria a conexão usando PDO
        // DSN = Data Source Name → mysql:host=...;dbname=...
        $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);

        // Define o modo de erro do PDO para lançar exceções (mais fácil de debugar)
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // =========================
        // RECEBENDO DADOS DO FORM
        // =========================
        // Cada campo é capturado pelo método POST
        // O "name" do input no HTML deve ser igual à chave usada aqui

        $nome           = $_POST['nome'];
        $senha          = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
        // Criptografa a senha para não armazenar em texto puro no banco
        // PASSWORD_DEFAULT = usa o algoritmo recomendado pelo PHP (atualmente bcrypt)

        $cpf            = $_POST['cpf'];
        $nivel_acesso   = $_POST['nivel_acesso'];
        $email          = $_POST['email'];
        $telefone       = $_POST['telefone'];
        $endereco       = $_POST['endereco'];
        $obs            = $_POST['obs'];
        $status         = $_POST['status'];
        $cadastrado_por = $_POST['cadastrado_por'];

        // =========================
        // QUERY DE INSERÇÃO
        // =========================
        // Usamos parâmetros nomeados (:nome, :senha, etc) para evitar SQL Injection

        $sql = "INSERT INTO tb_usuario 
            (nome, senha, cpf, nivel_acesso, email, telefone, endereco, obs, status, cadastrado_por) 
            VALUES 
            (:nome, :senha, :cpf, :nivel_acesso, :email, :telefone, :endereco, :obs, :status, :cadastrado_por)";

        // Prepara a query (evita SQL injection e melhora desempenho)
        $stmt = $pdo->prepare($sql);

        // Faz o bind (associa) cada parâmetro ao valor recebido
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nivel_acesso', $nivel_acesso);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':obs', $obs);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':cadastrado_por', $cadastrado_por);

        // =========================
        // EXECUTANDO A QUERY
        // =========================
        if ($stmt->execute()) {
            // Se der certo, mostra mensagem de sucesso
            echo "Usuário cadastrado com sucesso!";
        } else {
            // Se der erro, mostra mensagem de falha
            echo "Erro ao cadastrar usuário!";
        }

    } catch (PDOException $e) {
        // Caso aconteça algum erro na conexão ou execução, captura a exceção
        echo "Erro: " . $e->getMessage();
    }
?>
