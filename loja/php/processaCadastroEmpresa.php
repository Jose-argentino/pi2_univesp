<?php

    include "partes/validaSession.php";
    // Inclui conexão com banco de dados
    include "partes/conexao.php";

    try {
        // Cria a conexão usando PDO
        // DSN = Data Source Name → mysql:host=...;dbname=...
        $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);

        // Define o modo de erro do PDO para lançar exceções (mais fácil de debugar)
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Cada campo é capturado pelo método POST

        // Captura o id do usuário armazenado na sessão
        $id = $_SESSION['id_usuario'];
    
        $nome = $_POST['nome'];

        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
        // Criptografa a senha para não armazenar em texto puro no banco
        // PASSWORD_DEFAULT = usa o algoritmo recomendado pelo PHP (atualmente bcrypt)

        $cpf            = $_POST['cpf'];
        $nivel_acesso   = $_POST['nivel_acesso'];
        $email          = $_POST['email'];
        $telefone       = $_POST['telefone'];
        $endereco       = $_POST['endereco'];
        $obs            = $_POST['obs'];
        $status_usuario = $_POST['status_usuario'];
        $sobreNome      = $_POST['sobreNome'];

        $sql = "INSERT INTO tb_usuario 
            (nome, senha, cpf, nivel_acesso, email, telefone, endereco, obs, status_usuario, cadastrado_por,sobreNome) 
            VALUES 
            (:nome, :senha, :cpf, :nivel_acesso, :email, :telefone, :endereco, :obs, :status_usuario, :cadastrado_por, :sobreNome)";

        // Prepara a query (evita SQL injection e melhora desempenho)
        $stmt = $pdo->prepare($sql);

        // Faz o bind (associa) cada parâmetro ao valor recebido
        $stmt->bindParam(':cadastrado_por', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':sobreNome', $sobreNome);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nivel_acesso', $nivel_acesso);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':obs', $obs);
        $stmt->bindParam(':status_usuario', $status_usuario);
    

        if ($stmt->execute()) {
            // Exibe mensagem e redireciona com JavaScript
            echo "<script>
                alert('Usuário cadastrado com sucesso!');
                window.location.href = '../cadastroUse.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao cadastrar usuário!');
                window.location.href = '../cadastroUse.php';
            </script>";
        }


    } catch (PDOException $e) {
        // Caso aconteça algum erro na conexão ou execução, captura a exceção
        echo "Erro: " . $e->getMessage();
    }
?>
