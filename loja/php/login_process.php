<?php
// Inicia a sessão
session_start();

// Inclui a conexão com o banco de dados
include "partes/conexao.php";

// Exibe erros na tela (útil para testes)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se o formulário foi enviado corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura e limpa os dados enviados
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se os campos estão preenchidos
    if (empty($email) || empty($senha)) {
        header("Location: ../../index.php?erro=" . urlencode("Preencha todos os campos"));
        exit;
    }

    try {
        // Busca o usuário no banco pelo e-mail (somente se ativo)
        $sql = "SELECT nome, senha, email, id, status_usuario, nivel_acesso 
                FROM tb_usuario 
                WHERE email = :email AND status_usuario = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe e se a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {

            // Cria variáveis de sessão
            $_SESSION['id_sistema'] = '_Loja_roupa';       
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['status_usuario'] = $usuario['status_usuario'];
            $_SESSION['nome'] = $usuario['nome'];   
            $_SESSION['nivel_acesso'] = $usuario['nivel_acesso'];

            // Redireciona para a página principal
            header("Location: ../home.php");
            exit;

        } else {
            // Usuário não existe ou senha incorreta
            header("Location: ../../index.php?erro=" . urlencode("Dados inválidos"));
            exit;
        }

    } catch (PDOException $err) {
        // Caso ocorra erro no banco
        header("Location: ../../index.php?erro=" . urlencode("Erro no servidor"));
        exit;
    }

} else {
    // Se o acesso não foi via formulário POST
    header("Location: ../../index.php?erro=" . urlencode("Requisição inválida"));
    exit;
}
?>
