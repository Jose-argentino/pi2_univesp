<?php
// js/listaModelos.php
// ATENÇÃO: Verifique o caminho. Se este arquivo está em 'js/', o caminho é '../php/partes/conexao.php'
include_once "../php/partes/conexao.php"; 

header('Content-Type: application/json; charset=utf-8');

try {
    // Conexão e configuração do PDO (assumindo que $pdo ou $conn é definido em conexao.php)
    $db = isset($pdo) ? $pdo : $conn;
    
    // Consulta com JOIN para trazer os nomes em vez dos IDs
    $sql = "SELECT 
                m.id, 
                m.partNumber, 
                m.titulo, 
                f.fornecedor AS fornecedor_nome, 
                c.categoria AS categoria_nome
            FROM tb_modelo m
            JOIN tb_fornecedor f ON m.fornecedor = f.id
            JOIN tb_categoria c ON m.categoria = c.id
            ORDER BY m.titulo ASC";
            
    $stmt = $db->query($sql);
    $modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($modelos);
} catch (PDOException $e) {
    http_response_code(500); 
    echo json_encode(["erro" => "Erro na consulta: " . $e->getMessage()]);
}
?>