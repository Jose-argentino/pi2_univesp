<?php
include "partes/validaSession.php";
include "partes/conexao.php";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
    if (!$id_usuario) {
        echo "Erro: ID de usuário inválido.";
        exit;
    }

    $nome = $_POST['nome'] ?? '';
    $sobreNome = $_POST['sobreNome'] ?? '';
    $senha_raw = $_POST['senha'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $nivel_acesso = $_POST['nivel_acesso'] ?? null;
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $obs = $_POST['obs'] ?? '';
    $status_usuario = isset($_POST['status_usuario']) ? $_POST['status_usuario'] : 1;

    if (empty($nome) || empty($sobreNome) || empty($cpf) || empty($nivel_acesso) || empty($email)) {
        echo "Erro: Preencha todos os campos obrigatórios.";
        exit;
    }

    // Monta SQL dinamicamente para permitir atualizar senha apenas se foi informada
    $params = [
        ':nome' => $nome,
        ':sobreNome' => $sobreNome,
        ':cpf' => $cpf,
        ':nivel_acesso' => $nivel_acesso,
        ':email' => $email,
        ':telefone' => $telefone,
        ':endereco' => $endereco,
        ':obs' => $obs,
        ':status_usuario' => $status_usuario,
        ':id' => $id_usuario
    ];

    $sql = "UPDATE tb_usuario SET
                nome = :nome,
                sobreNome = :sobreNome,
                cpf = :cpf,
                nivel_acesso = :nivel_acesso,
                email = :email,
                telefone = :telefone,
                endereco = :endereco,
                obs = :obs,
                status_usuario = :status_usuario";

    if (!empty($senha_raw)) {
        $senha_hash = password_hash($senha_raw, PASSWORD_DEFAULT);
        $sql .= ", senha = :senha";
        $params[':senha'] = $senha_hash;
    }

    $sql .= " WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $executou = $stmt->execute($params);

    if ($executou) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Nenhuma alteração realizada ou erro na atualização.";
    }

} catch (PDOException $e) {
    error_log("atualizaUse erro: " . $e->getMessage());
    echo "Erro ao atualizar usuário: " . $e->getMessage();
}
?>
