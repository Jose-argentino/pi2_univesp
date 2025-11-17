<?php
    // php/processaEstoque.php
    include "partes/validaSession.php";
    include "partes/conexao.php";

    header('Content-Type: text/plain; charset=utf-8');

    try {
        $db = isset($pdo) ? $pdo : $conn;
        
        // Dados recebidos do formulário
        $cod_produto        = $_POST['cod_produto']; /* CORRIGIDO: de modelo para 'cod_produto' */
        $quantidade         = $_POST['quantidade'];  /* CORRIGIDO: de quantidade_atual para 'quantidade' */
        $estoque_minimo     = $_POST['estoque_minimo'];
        $valor_venda        = $_POST['valor_venda'];
        $desconto           = $_POST['desconto'];    /* CORRIGIDO: de deducao para 'desconto' */
        $usuario_id         = $_SESSION['id_usuario']; 

        $sql = "INSERT INTO tb_estoque 
                    (cod_produto, quantidade, estoque_minimo, valor_venda, desconto, cadastrado_por) 
                VALUES 
                    (:cod_produto, :quantidade, :estoque_minimo, :valor_venda, :desconto, :cadastrado_por)";
                
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':cod_produto', $cod_produto);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':estoque_minimo', $estoque_minimo);
        $stmt->bindParam(':valor_venda', $valor_venda);
        $stmt->bindParam(':desconto', $desconto);
        $stmt->bindParam(':cadastrado_por', $usuario_id);
        
        if ($stmt->execute()) {
            echo "Item de estoque cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar item de estoque.";
        }

    } catch (PDOException $e) {
        echo "Erro de Banco de Dados: " . $e->getMessage();
    }
?>