<?php
include "partes/validaSession.php";
include "partes/conexao.php";

header('Content-Type: application/json; charset=utf-8');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo json_encode(['erro' => 'ID inválido.']);
    exit;
}

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("DELETE FROM tb_usuario WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['sucesso' => 'Usuário excluído com sucesso.']);
    } else {
        echo json_encode(['erro' => 'Usuário não encontrado ou já removido.']);
    }

} catch (PDOException $e) {
    error_log("excluirUse erro: " . $e->getMessage());
    echo json_encode(['erro' => 'Erro ao excluir usuário.']);
}
?>
