<?php
include "partes/validaSession.php";
include "partes/conexao.php";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Campos
    $cadastrado_por = $_SESSION['id_usuario'] ?? null;
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

    // Validações simples
    if (empty($nome) || empty($sobreNome) || empty($cpf) || empty($nivel_acesso) || empty($email)) {
        echo "Erro: Preencha todos os campos obrigatórios.";
        exit;
    }

    // Senha: se fornecida, hash; se não, null
    $senha = null;
    if (!empty($senha_raw)) {
        $senha = password_hash($senha_raw, PASSWORD_DEFAULT);
    }

    $sql = "INSERT INTO tb_usuario 
        (nome, sobreNome, senha, cpf, nivel_acesso, email, telefone, endereco, obs, status_usuario, cadastrado_por)
        VALUES
        (:nome, :sobreNome, :senha, :cpf, :nivel_acesso, :email, :telefone, :endereco, :obs, :status_usuario, :cadastrado_por)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':sobreNome', $sobreNome);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':nivel_acesso', $nivel_acesso);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':obs', $obs);
    $stmt->bindParam(':status_usuario', $status_usuario);
    $stmt->bindParam(':cadastrado_por', $cadastrado_por);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário.";
    }

} catch (PDOException $e) {
    error_log("processaCadastroUse erro: " . $e->getMessage());
    echo "Erro ao processar cadastro: " . $e->getMessage();
}
?>
