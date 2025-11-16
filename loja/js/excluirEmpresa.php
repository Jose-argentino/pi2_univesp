<?php
// js/excluirEmpresa.php

// MUDANÇA AQUI: Caminho corrigido
include_once "../php/partes/conexao.php";
include "../php/partes/validaSession.php";

header('Content-Type: text/plain; charset=utf-8');

if (!isset($pdo) && !isset($conn) && isset($servername,$database,$username,$password)) {
    try { $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password); }
    catch (Exception $e) { echo "Erro de conexão"; exit; }
}

$db = isset($pdo) ? $pdo : $conn; // Escolhe qual variável PDO usar
$id = intval($_GET['id'] ?? 0);
if (!$id) { echo "ID inválido"; exit; }

try {
    $stmt = $db->prepare("DELETE FROM tb_fornecedor WHERE id = :id");
    $stmt->execute([':id'=>$id]);

    echo "Fornecedor excluído com sucesso!";
} catch (PDOException $e) {
    error_log("excluirEmpresa: " . $e->getMessage());
    echo "Erro ao excluir: " . $e->getMessage();
}
?>