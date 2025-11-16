<?php
include "../php/partes/conexao.php";

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id'])) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

$id = $_GET['id'];

$sql = "SELECT id, nome, sobreNome, cpf, email, telefone,
        endereco, obs, nivel_acesso, status_usuario 
        FROM tb_usuario 
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($usuario);
