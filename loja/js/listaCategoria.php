<?php
include "../php/partes/conexao.php";

$sql = "SELECT id, categoria, obs, cadastrado_por, data_cad 
        FROM tb_categoria 
        ORDER BY categoria ASC";

$stmt = $conn->prepare($sql);
$stmt->execute();

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($categorias);
