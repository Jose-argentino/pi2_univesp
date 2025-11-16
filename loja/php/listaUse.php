<?php
include "partes/validaSession.php";
include "partes/conexao.php";

header('Content-Type: application/json; charset=utf-8');

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT u.id AS id_usuario, u.nome, u.sobreNome, u.email, u.cpf, u.telefone, u.endereco, u.obs, u.status_usuario, a.niv_acesso
            FROM tb_usuario u
            LEFT JOIN tb_acesso a ON u.nivel_acesso = a.id
            ORDER BY u.nome ASC";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rows);

} catch (PDOException $e) {
    error_log("listaUse erro: " . $e->getMessage());
    echo json_encode([]);
}
?>
