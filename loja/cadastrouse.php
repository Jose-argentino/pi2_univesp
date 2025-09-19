<?php
include "backend/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Gera hash seguro da senha
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO tb_usuario (email, senha) VALUES (:email, :senha)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $hash);
    $stmt->execute();

    echo "Usuário cadastrado com sucesso!";
}
