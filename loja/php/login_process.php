<?php
// Inicia sessão
session_start();

// Inclui conexão com banco de dados
include "partes/conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se o formulário foi enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura os dados do formulário
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    try {
        // Busca usuário pelo email
        $sql = "SELECT * FROM tb_usuario WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Retorna o usuário encontrado (ou false se não existir)
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login ok -> cria sessão
            $_SESSION['id_sistema'] = '_Loja_roupa';       
            $_SESSION['email'] = $usuario['email'];   
            $_SESSION['id_usuario'] = $usuario['id'];

            header("Location: ../home.php");
            exit;
        } else {
            // Usuário não existe OU senha inválida
            header("Location: ../../index.php?erro=" . urlencode("Dados inválidos"));
            exit;
        }

    } catch (PDOException $err) {
        // Erro no banco
        header("Location: ../../index.php?erro=" . urlencode("Erro no servidor"));
        exit;
    }

} else {
    // Se o acesso não foi via POST
    header("Location: ../../index.php?erro=" . urlencode("Requisição inválida"));
    exit;
}