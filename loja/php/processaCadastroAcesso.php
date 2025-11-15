<?php

    include "partes/validaSession.php";
    include "partes/conexao.php";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);

        // Define o modo de erro do PDO para lançar exceções 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id                 = $_SESSION['id_usuario'];
        $niv_acesso         =$_POST['niv_acesso'];
        $obs                = $_POST['obs'];

        $sql = "INSERT INTO tb_acesso 
            (niv_acesso, obs, cadastrado_por) 
            VALUES 
            (:niv_acesso, :obs, :cadastrado_por)";
            
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cadastrado_por', $id);
        $stmt->bindParam(':niv_acesso', $niv_acesso);
        $stmt->bindParam(':obs', $obs);
    
        if ($stmt->execute()) {
            // Exibe mensagem e redireciona com JavaScript
            echo "'Cadastrado com sucesso!'";
        } else {
            echo "Erro ao cadastrar fornecedor!";
        }


    } catch (PDOException $e) {
        // Caso aconteça algum erro na conexão ou execução, captura a exceção
        echo "Erro: " . $e->getMessage();
    }
?>
