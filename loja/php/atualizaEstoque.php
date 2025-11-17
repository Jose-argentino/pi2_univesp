<?php
// php/atualizaEstoque.php
include "partes/validaSession.php";
include "partes/conexao.php";

header('Content-Type: text/plain; charset=utf-8');

try {
    $db = isset($pdo) ? $pdo : $conn;
    
    // Dados recebidos do formulário
    $id                 = $_POST['id'] ?? 0;
    $modelo             = $_POST['modelo'];
    $quantidade_atual   = $_POST['quantidade_atual'];
    $estoque_minimo     = $_POST['estoque_minimo'];
    $valor_venda        = $_POST['valor_venda'];
    $deducao            = $_POST['deducao'];
    $usuario_id         = $_SESSION['id_usuario'];

    if (!$id || !is_numeric($id)) {
        echo "ID de estoque inválido para atualização.";
        exit;
    }

    $sql = "UPDATE tb_estoque SET
                modelo = :modelo,
                quantidade_atual = :quantidade_atual,
                estoque_minimo = :estoque_minimo,
                valor_venda = :valor_venda,
                deducao = :deducao,
                cadastrado_por = :cadastrado_por
            WHERE id = :id";
            
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':modelo', $modelo);
    $stmt->bindParam(':quantidade_atual', $quantidade_atual);
    $stmt->bindParam(':estoque_minimo', $estoque_minimo);
    $stmt->bindParam(':valor_venda', $valor_venda);
    $stmt->bindParam(':deducao', $deducao);
    $stmt->bindParam(':cadastrado_por', $usuario_id);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        echo "Item de estoque atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar item de estoque.";
    }

} catch (PDOException $e) {
    echo "Erro de Banco de Dados: " . $e->getMessage();
}
?>