<?php
// js/buscaEmpresa.php

// MUDANÇA AQUI: Caminho corrigido
include_once "../php/partes/conexao.php";

if (!isset($pdo) && !isset($conn)) {
    if (isset($servername,$database,$username,$password)) {
        try { $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password); }
        catch (Exception $e) { echo json_encode(["erro" => "Erro de Conexão no PDO"]); exit; }
    } else { echo json_encode(["erro" => "Variáveis de conexão não definidas"]); exit; }
}

header('Content-Type: application/json; charset=utf-8');

$db = isset($pdo) ? $pdo : $conn; // Escolhe qual variável PDO usar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$id) { echo json_encode(["erro" => "ID não fornecido"]); exit; }

try {
    $stmt = $db->prepare("SELECT * FROM tb_fornecedor WHERE id = :id LIMIT 1");
    $stmt->execute([':id'=>$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Retorna a linha encontrada ou um objeto vazio se não encontrou (para o JS não quebrar)
    echo json_encode($row ?: []);
} catch (PDOException $e) {
    error_log("buscaEmpresa erro: " . $e->getMessage());
    echo json_encode(["erro" => "Erro na consulta"]);
}
?>