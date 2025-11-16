<?php
include "../php/partes/conexao.php";

if (!isset($_GET['id'])) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM tb_categoria WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt->execute([$id])) {
    echo json_encode(["sucesso" => "Categoria excluída com sucesso!"]);
} else {
    echo json_encode(["erro" => "Erro ao excluir categoria."]);
}
