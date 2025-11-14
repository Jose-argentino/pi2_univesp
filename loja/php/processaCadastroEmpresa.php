<?php

    include "partes/validaSession.php";
    include "partes/conexao.php";

    try {
        // Cria a conexão usando PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);

        // Define o modo de erro do PDO para lançar exceções 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id    = $_SESSION['id_usuario'];
        
        $fornecedor     =$_POST['fornecedor'];
        $vendedor       =$_POST['vendedor'];
        $cnpj           = $_POST['cnpj'];
        $email          = $_POST['email'];
        $telefone       = $_POST['telefone'];
        $endereco       = $_POST['endereco'];
        $obs            = $_POST['obs'];

        $sql = "INSERT INTO tb_fornecedor 
            (fornecedor, vendedor, cnpj, email, telefone, endereco, obs, cadastrado_por) 
            VALUES 
            (:fornecedor, :vendedor, :cnpj, :email, :telefone, :endereco, :obs, :cadastrado_por)";

        // Prepara a query (evita SQL injection e melhora desempenho)
        $stmt = $pdo->prepare($sql);

        // Faz o bind (associa) cada parâmetro ao valor recebido
        $stmt->bindParam(':cadastrado_por', $id);
        $stmt->bindParam(':fornecedor', $fornecedor);
        $stmt->bindParam(':vendedor', $vendedor);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':obs', $obs);
    
        if ($stmt->execute()) {
            // Exibe mensagem e redireciona com JavaScript
            echo "<script>
                alert('Fornecedor cadastrado com sucesso!');
                window.location.href = '../cadastroEmpresa.php';
            </script>";
        } else {
            echo "<script>
                alert('Erro ao cadastrar fornecedor!');
                window.location.href = '../cadastroEmpresa.php';
            </script>";
        }


    } catch (PDOException $e) {
        // Caso aconteça algum erro na conexão ou execução, captura a exceção
        echo "Erro: " . $e->getMessage();
    }
?>
