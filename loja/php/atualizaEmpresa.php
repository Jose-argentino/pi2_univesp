<?php
include_once "partes/conexao.php";
header('Content-Type: text/plain; charset=utf-8');

if (!isset($pdo) && !isset($conn) && isset($servername,$database,$username,$password)) {
    try { $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password); }
    catch (Exception $e) { echo "Erro de conexão"; exit; }
}

try {
    $id = intval($_POST['id'] ?? 0);
    if (!$id) { echo "ID inválido"; exit; }

    $params = [
        ':fornecedor'=>$_POST['fornecedor'] ?? '',
        ':vendedor'=>$_POST['vendedor'] ?? '',
        ':cnpj'=>$_POST['cnpj'] ?? '',
        ':email'=>$_POST['email'] ?? '',
        ':telefone'=>$_POST['telefone'] ?? '',
        ':endereco'=>$_POST['endereco'] ?? '',
        ':obs'=>$_POST['obs'] ?? '',
        ':id'=>$id
    ];

    $sql = "UPDATE tb_fornecedor SET fornecedor=:fornecedor, vendedor=:vendedor, cnpj=:cnpj, email=:email, telefone=:telefone, endereco=:endereco, obs=:obs WHERE id=:id";

    if (isset($pdo)) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    } else {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
    }

    echo "Fornecedor atualizado com sucesso!";
} catch (PDOException $e) {
    error_log("atualizaEmpresa: " . $e->getMessage());
    echo "Erro ao atualizar: " . $e->getMessage();
}
