<?php
// Inclui as partes essenciais: validação de sessão e conexão com o banco
include "partes/validaSession.php";
include "partes/conexao.php"; // Presume que este arquivo define $servername, $database, $username, $password

// 1. Verifica se os dados necessários foram recebidos via POST
if (!isset($_POST['id_acesso']) || !isset($_POST['niv_acesso'])) {
    // Retorna uma mensagem de erro se faltarem dados
    echo "Erro: Dados incompletos para a atualização.";
    exit;
}

// 2. Coleta e sanitiza os dados do formulário
$id_acesso = filter_input(INPUT_POST, 'id_acesso', FILTER_VALIDATE_INT);
$niv_acesso = filter_input(INPUT_POST, 'niv_acesso', FILTER_SANITIZE_STRING);
$obs = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING) ?? ''; // Usa string vazia se 'obs' for nulo

// 3. Validação básica do ID (garante que é um número válido)
if (!$id_acesso) {
    echo "Erro: ID de acesso inválido.";
    exit;
}

try {
    // 4. Conexão com o banco de dados (usando as variáveis de conexao.php)
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 5. Comando SQL UPDATE seguro (usando Prepared Statement com named placeholders)
    $sql = "UPDATE tb_acesso 
            SET niv_acesso = :niv_acesso, 
                obs = :obs
            WHERE id = :id";
            
    $stmt = $pdo->prepare($sql);

    // 6. Bind dos valores (prevenção contra SQL Injection)
    $stmt->bindParam(':niv_acesso', $niv_acesso, PDO::PARAM_STR);
    $stmt->bindParam(':obs', $obs, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id_acesso, PDO::PARAM_INT);

    // 7. Execução do comando
    $stmt->execute();

    // 8. Verifica se alguma linha foi afetada (se a atualização realmente ocorreu)
    if ($stmt->rowCount() > 0) {
        echo "Sucesso: Nível de Acesso atualizado com êxito!";
    } else {
        // Pode significar que os dados não mudaram ou que o ID não existe
        echo "Aviso: Nenhuma alteração foi feita, ou o registro não foi encontrado.";
    }

} catch (PDOException $e) {
    // 9. Tratamento de erro do banco de dados
    // Em um ambiente de produção, esta mensagem deve ser mais genérica
    error_log("Erro ao atualizar acesso: " . $e->getMessage()); 
    echo "Erro: Falha ao atualizar o nível de acesso no banco de dados. " . $e->getMessage();
}

?>