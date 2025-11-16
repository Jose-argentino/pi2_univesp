<?php
include "../php/partes/conexao.php";

if (!isset($_GET['id'])) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM tb_usuario WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt->execute([$id])) {
    echo json_encode(["sucesso" => "Usuário excluído com sucesso!"]);
} else {
    echo json_encode(["erro" => "Erro ao excluir usuário."]);
}
