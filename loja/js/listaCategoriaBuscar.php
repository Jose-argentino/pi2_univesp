<?php
include "../php/partes/conexao.php";

if (!isset($_GET['id'])) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

$id = $_GET['id'];

$sql = "SELECT id, categoria, obs 
        FROM tb_categoria 
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($categoria);
