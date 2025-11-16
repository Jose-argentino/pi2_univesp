<?php
include "../php/partes/conexao.php";

$sql = "SELECT id, nome, email, telefone, status_usuario 
        FROM tb_usuario 
        ORDER BY nome ASC";

$stmt = $conn->prepare($sql);
$stmt->execute();

$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($usuarios);
