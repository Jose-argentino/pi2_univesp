<?php
include "partes/validaSession.php";
include "partes/conexao.php";

header('Content-Type: application/json; charset=utf-8');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo json_encode([]);
    exit;
}

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT u.id AS id_usuario, u.nome, u.sobreNome, u.email, u.cpf, u.telefone, u.endereco, u.obs, u.status_usuario, u.nivel_acesso
            FROM tb_usuario u
            WHERE u.id = :id
            LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }

} catch (PDOException $e) {
    error_log("getUse erro: " . $e->getMessage());
    echo json_encode([]);
}
?>
