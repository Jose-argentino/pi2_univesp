<?php

    include "partes/validaSession.php";
    include "partes/conexao.php";

    try {
        // Cria a conexão usando PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);

        // Define o modo de erro do PDO para lançar exceções 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id                 = $_SESSION['id_usuario'];
        $fornecedor         =$_POST['fornecedor'];
        $categoria          =$_POST['categoria'];
        $partNumber          = $_POST['partNumber'];
        $titulo             = $_POST['titulo'];
        $caracteristica     = $_POST['caracteristica'];
        $obs                = $_POST['obs'];

        $sql = "INSERT INTO tb_modelo 
            (fornecedor, categoria, partNumber, titulo, caracteristica, obs, cadastrado_por) 
            VALUES 
            (:fornecedor, :categoria, :partNumber, :titulo, :caracteristica, :obs, :cadastrado_por)";
            
        // Prepara a query (evita SQL injection e melhora desempenho)
        $stmt = $pdo->prepare($sql);

        // Faz o bind (associa) cada parâmetro ao valor recebido
        $stmt->bindParam(':cadastrado_por', $id);
        $stmt->bindParam(':fornecedor', $fornecedor);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':partNumber', $partNumber);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':caracteristica', $caracteristica);
        $stmt->bindParam(':obs', $obs);
    
        if ($stmt->execute()) {
            // Exibe mensagem e redireciona com JavaScript
            echo "<script>
                alert('Modelo cadastrado com sucesso!');
                window.location.href = '../cadastroModelo.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao cadastrar fornecedor!');
                window.location.href = '../cadastroModelo.php';
            </script>";
        }


    } catch (PDOException $e) {
        // Caso aconteça algum erro na conexão ou execução, captura a exceção
        echo "Erro: " . $e->getMessage();
    }
?>
