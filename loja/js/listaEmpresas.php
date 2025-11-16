<?php
// js/listaEmpresas.php

// MUDANÇA AQUI: Caminho corrigido para subir um nível (..) e acessar a pasta php
include_once "../php/partes/conexao.php";
include "../php/partes/validaSession.php";

// Tenta criar $pdo se necessário (melhor movido para conexao.php, mas mantido para consistência)
if (!isset($pdo) && !isset($conn)) {
    if (isset($servername,$database,$username,$password)) {
        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["erro" => "Erro de Conexão no PDO"]); // Melhor erro para o JS
            exit;
        }
    } else {
        http_response_code(500);
        echo json_encode(["erro" => "Variáveis de conexão não definidas"]); 
        exit;
    }
}

header('Content-Type: application/json; charset=utf-8');

try {
    // Escolhe qual variável PDO usar
    $db = isset($pdo) ? $pdo : $conn;
    
    $stmt = $db->query("SELECT id, fornecedor, vendedor, cnpj, email, telefone FROM tb_fornecedor ORDER BY fornecedor ASC");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rows);
} catch (PDOException $e) {
    error_log("listaEmpresas erro: " . $e->getMessage());
    http_response_code(500);
    // Retorna um JSON de erro para que o JS possa tratá-lo se necessário
    echo json_encode(["erro" => "Erro na consulta: " . $e->getMessage()]);
}
?>