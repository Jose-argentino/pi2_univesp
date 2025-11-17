<?php
// php/atualizaModelo.php
include "partes/validaSession.php";
include "partes/conexao.php";

header('Content-Type: text/plain; charset=utf-8');

try {
    $db = isset($pdo) ? $pdo : $conn;
    
    // Dados recebidos do formulário, incluindo o ID oculto
    $id             = $_POST['id'] ?? 0;
    $fornecedor     = $_POST['fornecedor'];
    $categoria      = $_POST['categoria'];
    $partNumber     = $_POST['partNumber'];
    $titulo         = $_POST['titulo'];
    $caracteristica = $_POST['caracteristica'];
    $obs            = $_POST['obs'];
    $usuario_id     = $_SESSION['id_usuario']; // Quem está atualizando

    if (!$id || !is_numeric($id)) {
        echo "ID de modelo inválido para atualização.";
        exit;
    }

    $sql = "UPDATE tb_modelo SET
                fornecedor = :fornecedor,
                categoria = :categoria,
                partNumber = :partNumber,
                titulo = :titulo,
                caracteristica = :caracteristica,
                obs = :obs,
                cadastrado_por = :cadastrado_por
            WHERE id = :id";
            
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':fornecedor', $fornecedor);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':partNumber', $partNumber);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':caracteristica', $caracteristica);
    $stmt->bindParam(':obs', $obs);
    $stmt->bindParam(':cadastrado_por', $usuario_id);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        echo "Modelo atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar modelo.";
    }

} catch (PDOException $e) {
    echo "Erro de Banco de Dados: " . $e->getMessage();
}
?>