<?php

    include "partes/validaSession.php";
    include "partes/conexao.php";

    try {
        // Cria a conexão usando PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);

        // Define o modo de erro do PDO para lançar exceções 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id                 = $_SESSION['id_usuario'];
        $categoria         =$_POST['categoria'];
        $obs                = $_POST['obs'];

        $sql = "INSERT INTO tb_categoria 
            (categoria, obs, cadastrado_por) 
            VALUES 
            (:categoria, :obs, :cadastrado_por)";
            
        // Prepara a query (evita SQL injection e melhora desempenho)
        $stmt = $pdo->prepare($sql);

        // Faz o bind (associa) cada parâmetro ao valor recebido
        $stmt->bindParam(':cadastrado_por', $id);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':obs', $obs);
    
        if ($stmt->execute()) {
            // Exibe mensagem e redireciona com JavaScript
            echo "Modelo cadastrado com sucesso!";
                
            
        } else {
            echo "<script>
                alert('Erro ao cadastrar fornecedor!');
                window.location.href = '../cadastroCategoria.php';
            </script>";
        }


    } catch (PDOException $e) {
        // Caso aconteça algum erro na conexão ou execução, captura a exceção
        echo "Erro: " . $e->getMessage();
    }
?>
