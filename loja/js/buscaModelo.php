<?php
// js/buscaModelo.php
include_once "../php/partes/conexao.php";

header('Content-Type: application/json; charset=utf-8');

$db = isset($pdo) ? $pdo : $conn;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$id) { echo json_encode(["erro" => "ID não fornecido"]); exit; }

try {
    // Busca todas as colunas, incluindo os IDs 'fornecedor' e 'categoria' para preencher os SELECTs no JS
    $stmt = $db->prepare("SELECT * FROM tb_modelo WHERE id = :id LIMIT 1");
    $stmt->execute([':id'=>$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($row ?: []);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro na busca: " . $e->getMessage()]);
}
?>