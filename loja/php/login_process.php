<?php
// Inicia sessão
session_start();

// Inclui conexão com banco de dados
include "conexao.php";

// Verifica se o formulário foi enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        // Busca usuário pelo email
        $sql = "SELECT * FROM tb_usuario WHERE email = :email LIMIT 1;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Retorna o usuário encontrado (ou false se não existir)
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se encontrou usuário e a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {

            // Define variáveis de sessão
            $_SESSION['id_sistema'] = '_Loja_roupa';       
            $_SESSION['email'] = $usuario['email'];   
            $_SESSION['id_usuario'] = $usuario['id'];

            // Redireciona para a página principal
            header("Location: ../home.php");
            exit;

        } else {
            // Senha ou usuário inválido → redireciona com erro
            header("Location: ../../home.php?erro=" . urlencode("Dados inválidos"));
            exit;
        }

    } catch (PDOException $err) {
        // Erro de banco → redireciona com mensagem genérica
        header("Location: ,,/../home.php?erro=" . urlencode("Erro no servidor"));
        exit;
    }

} else {
    // Se o acesso não foi via POST, redireciona para login
    header("Location: ../../home.php?erro=" . urlencode("Requisição inválida"));
    exit;
}