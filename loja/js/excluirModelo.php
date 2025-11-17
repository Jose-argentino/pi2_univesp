<?php
// js/excluirModelo.php
include_once "../php/partes/conexao.php";
include "../php/partes/validaSession.php"; // Necessário para validação

header('Content-Type: text/plain; charset=utf-8');

$db = isset($pdo) ? $pdo : $conn;
$id = intval($_GET['id'] ?? 0);

if (!$id) { echo "ID inválido para exclusão"; exit; }

try {
    $stmt = $db->prepare("DELETE FROM tb_modelo WHERE id = :id");
    $stmt->execute([':id'=>$id]);

    if ($stmt->rowCount() > 0) {
        echo "Modelo excluído com sucesso!";
    } else {
        echo "Modelo não encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro ao excluir: " . $e->getMessage();
}
?>