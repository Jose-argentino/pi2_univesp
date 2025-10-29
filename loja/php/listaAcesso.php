<?php
include "partes/conexao.php";

header('Content-Type: application/json; charset=utf-8');

try {
    // Conexão com PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta todos os registros da tabela (agora com campo correto)
    $sql = "SELECT id, niv_acesso, obs FROM tb_acesso ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    $acessos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna como JSON
    echo json_encode($acessos);
} catch (PDOException $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}
?>