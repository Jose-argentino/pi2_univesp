<?php
session_start();
require_once "conexao.php";

echo "<pre>";
print_r($_POST);
echo "</pre>";
exit;



<?php
// Inicia sessão
session_start();

// Inclui conexão com banco de dados
include "conexao.php";

ini_set('display_errors', 1); // Exibir erros diretamente na tela
ini_set('display_startup_errors', 1); // Exibe erros na inicialização do PHP
error_reporting(E_ALL); // Mostra todos os erros, avisos e notices

// Verifica se o formulário foi enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura os dados do formulário
    $email = trim($_POST['email']); // remove espaços extras
    $senha = $_POST['senha']; // senha sem trim()

    try {
        // Busca usuário pelo email
        $sql = "SELECT * FROM tb_usuario WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Retorna o usuário encontrado (ou false se não existir)
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            // Verifica senha
            if (password_verify($senha, $usuario['senha'])) {
                // Login ok -> cria sessão
                $_SESSION['id_sistema'] = '_Loja_roupa';       
                $_SESSION['email'] = $usuario['email'];   
                $_SESSION['id_usuario'] = $usuario['id'];

                // Redireciona para a página principal
                header("Location: ../home.php");
                exit;
            } else {
                // Senha incorreta
                header("Location: ../../index.php?erro=" . urlencode("Dados inválidos"));
                exit;
            }
        } else {
            // Usuário não encontrado
            header("Location: ../../index.php?erro=" . urlencode("Usuário não cadastrado"));
            exit;
        }

    } catch (PDOException $err) {
        // Erro de banco
        header("Location: ../../index.php?erro=" . urlencode("Erro no servidor"));
        exit;
    }

} else {
    // Se o acesso não foi via POST
    header("Location: ../../index.php?erro=" . urlencode("Requisição inválida"));
    exit;
}
