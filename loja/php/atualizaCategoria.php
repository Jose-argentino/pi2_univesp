<?php
include "partes/validaSession.php";
include "partes/conexao.php";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_POST['id']) || !isset($_POST['categoria'])) {
        echo "Dados inválidos.";
        exit;
    }

    $id             = $_POST['id'];
    $categoria      = $_POST['categoria'];
    $obs            = $_POST['obs'] ?? "";

    $sql = "UPDATE tb_categoria 
            SET categoria = :categoria,
                obs = :obs
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':obs', $obs);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Categoria atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar a categoria.";
    }

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
