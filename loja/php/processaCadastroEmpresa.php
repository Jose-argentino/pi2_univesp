<?php
include "partes/validaSession.php";
include_once "partes/conexao.php";
header('Content-Type: text/plain; charset=utf-8');

if (!isset($pdo) && !isset($conn) && isset($servername,$database,$username,$password)) {
    try { $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password); }
    catch (Exception $e) { echo "Erro de conexão"; exit; }
}

try {
    
    $fornecedor = $_POST['fornecedor'] ?? '';
    $vendedor = $_POST['vendedor'] ?? '';
    $cnpj = $_POST['cnpj'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $obs = $_POST['obs'] ?? '';
    $cadastrado_por = $_SESSION['id_usuario'] ?? null;

    if (empty($fornecedor) || empty($vendedor) || empty($cnpj) || empty($email)) {
        echo "Preencha os campos obrigatórios.";
        exit;
    }

    if (isset($pdo)) {
        $stmt = $pdo->prepare("INSERT INTO tb_fornecedor (fornecedor,vendedor,cnpj,email,telefone,endereco,obs,cadastrado_por) VALUES (:fornecedor,:vendedor,:cnpj,:email,:telefone,:endereco,:obs,:cadastrado_por)");
        $stmt->execute([
            ':fornecedor'=>$fornecedor,
            ':vendedor'=>$vendedor,
            ':cnpj'=>$cnpj,
            ':email'=>$email,
            ':telefone'=>$telefone,
            ':endereco'=>$endereco,
            ':obs'=>$obs,
            ':cadastrado_por'=>$cadastrado_por
        ]);
    } else {
        $stmt = $conn->prepare("INSERT INTO tb_fornecedor (fornecedor,vendedor,cnpj,email,telefone,endereco,obs,cadastrado_por) VALUES (:fornecedor,:vendedor,:cnpj,:email,:telefone,:endereco,:obs,:cadastrado_por)");
        $stmt->execute([
            ':fornecedor'=>$fornecedor,
            ':vendedor'=>$vendedor,
            ':cnpj'=>$cnpj,
            ':email'=>$email,
            ':telefone'=>$telefone,
            ':endereco'=>$endereco,
            ':obs'=>$obs,
            ':cadastrado_por'=>$cadastrado_por
        ]);
    }

    echo "Fornecedor cadastrado com sucesso!";
} catch (PDOException $e) {
    error_log("processaCadastroEmpresa: " . $e->getMessage());
    echo "Erro ao cadastrar: " . $e->getMessage();
}
