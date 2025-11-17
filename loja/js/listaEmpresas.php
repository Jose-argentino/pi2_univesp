<?php
// js/listaEmpresas.php
// 1. Desativa a exibição de erros na saída para não corromper o JSON.
ini_set('display_errors', 0);
error_reporting(E_ALL);

// 2. Inclui a sessão (se falhar, o include já pode emitir um erro se o arquivo não existir ou se houver saída)
include "../php/partes/validaSession.php"; 

// 3. Inclui a conexão (que deve definir $conn ou $pdo)
include "../php/partes/conexao.php"; 

// 4. Garante que o cabeçalho JSON seja enviado ANTES de qualquer saída (inclusive de um erro)
header('Content-Type: application/json; charset=utf-8');

try {
    // Tenta usar $pdo se estiver definido, senão usa $conn
    $db = isset($pdo) ? $pdo : $conn;
    
    if (!$db) {
        throw new Exception("Objeto de conexão com o banco de dados não está disponível.");
    }

    $stmt = $db->query("SELECT id, fornecedor, vendedor, cnpj, email, telefone FROM tb_fornecedor ORDER BY fornecedor ASC");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rows);
    exit; // Termina o script após o JSON
} catch (PDOException $e) {
    error_log("listaEmpresas PDO erro: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["erro" => "Erro na consulta ao banco de dados."]);
} catch (Exception $e) {
    error_log("listaEmpresas erro: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["erro" => "Erro interno no servidor."]);
}
// Não use a tag de fechamento ?>