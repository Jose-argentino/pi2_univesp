<?php

    include "partes/validaSession.php";
    include "partes/conexao.php";

    try {
        // Cria a conexão usando PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_SESSION['id_usuario'];
    
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 
        
        $nome = $_POST['nome'];
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

        $stmt = $pdo->prepare($sql);

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
        // Caso aconteça algum erro na conexão ou execução
        echo "Erro: " . $e->getMessage();
    }
?>
