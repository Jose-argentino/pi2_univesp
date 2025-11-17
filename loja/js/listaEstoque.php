<?php
// js/listaEstoque.php
ini_set('display_errors', 0);
error_reporting(E_ALL);

include "../php/partes/validaSession.php"; 
include "../php/partes/conexao.php"; 

header('Content-Type: application/json; charset=utf-8');

try {
    $db = isset($pdo) ? $pdo : $conn;
    
    $busca = $_GET['busca'] ?? '';
    $termosBusca = [];
    $where = 'WHERE 1=1';

    // Constrói a cláusula WHERE para pesquisa
    if ($busca) {
        $where .= " AND (
            m.titulo LIKE :busca_titulo OR
            m.partNumber LIKE :busca_partNumber OR
            f.fornecedor LIKE :busca_fornecedor OR
            c.categoria LIKE :busca_categoria
        )";
        $termosBusca[':busca_titulo'] = '%' . $busca . '%';
        $termosBusca[':busca_partNumber'] = '%' . $busca . '%';
        $termosBusca[':busca_fornecedor'] = '%' . $busca . '%';
        $termosBusca[':busca_categoria'] = '%' . $busca . '%';
    }

    // Consulta com JOINs (ATENÇÃO aos nomes das colunas da tb_estoque)
    $sql = "SELECT 
                e.id, 
                e.quantidade,          /* CORRIGIDO: de quantidade_atual para 'quantidade' */
                e.estoque_minimo,      /* MANTIDO: existe na tb_estoque agora */
                e.valor_venda, 
                e.desconto,            /* CORRIGIDO: de deducao para 'desconto' */
                m.partNumber,
                m.titulo, 
                f.fornecedor AS fornecedor_nome, 
                c.categoria AS categoria_nome
            FROM tb_estoque e
            JOIN tb_modelo m ON e.cod_produto = m.id /* CORRIGIDO: de modelo para 'cod_produto' */
            JOIN tb_fornecedor f ON m.fornecedor = f.id
            JOIN tb_categoria c ON m.categoria = c.id
            $where
            ORDER BY e.quantidade DESC, m.titulo ASC";
            
    $stmt = $db->prepare($sql);
    $stmt->execute($termosBusca);
    $estoque = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($estoque);
} catch (PDOException $e) {
    error_log("listaEstoque PDO erro: " . $e->getMessage());
    http_response_code(500); 
    echo json_encode(["erro" => "Erro na consulta ao banco: " . $e->getMessage()]);
}
// Não use a tag de fechamento ?>