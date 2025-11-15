<?php
include "../php/partes/validaSession.php";
include "../php/partes/conexao.php";

header('Content-Type: application/json'); // Garante que a resposta é JSON

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo json_encode(['error' => 'ID inválido.']);
    exit;
}

$id = intval($_GET['id']);

try {
    // Sua lógica de conexão e busca com PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, niv_acesso, obs FROM tb_acesso WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $acesso = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($acesso) {
        echo json_encode($acesso); // Retorna os dados como JSON
    } else {
        echo json_encode(['error' => 'Registro não encontrado.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
?>