<?php
// js/excluirEstoque.php
include_once "../php/partes/conexao.php";
include "../php/partes/validaSession.php"; 

header('Content-Type: text/plain; charset=utf-8');

$db = isset($pdo) ? $pdo : $conn;
$id = intval($_GET['id'] ?? 0);

if (!$id) { echo "ID inválido para exclusão."; exit; }

try {
    $stmt = $db->prepare("DELETE FROM tb_estoque WHERE id = :id");
    $stmt->execute([':id'=>$id]);

    if ($stmt->rowCount() > 0) {
        echo "Item de estoque excluído com sucesso!";
    } else {
        echo "Item de estoque não encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro ao excluir: " . $e->getMessage();
}
?>