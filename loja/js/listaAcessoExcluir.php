<?php
// Inclui as partes essenciais: conexão com o banco
include "../php/partes/conexao.php"; 

// Define que a resposta será JSON, ideal para comunicação com AJAX/Fetch
header('Content-Type: application/json; charset=utf-8');

// 1. Recebe o ID do registro enviado pela URL (via GET)
$id_acesso = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// 2. Verifica se o ID é válido
if (!$id_acesso) {
    echo json_encode(["erro" => "ID de acesso inválido ou não fornecido."]);
    exit;
}

try {
    // 3. Conexão com PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 4. Comando SQL DELETE SEGURO (usando placeholder ?)
    $sql = "DELETE FROM tb_acesso WHERE id = ?";
    
    // 5. Prepara o comando
    $stmt = $pdo->prepare($sql);
    
    // 6. Executa o comando, passando o ID
    $stmt->execute([$id_acesso]);

    // 7. Verifica se a exclusão foi bem-sucedida (se uma linha foi afetada)
    if ($stmt->rowCount() > 0) {
        $mensagem = "Nível de acesso excluído com sucesso!";
    } else {
        $mensagem = "Aviso: Nenhum registro encontrado para o ID " . $id_acesso . ".";
    }
    
    // 8. Retorna a mensagem para o JavaScript
    echo json_encode(["sucesso" => $mensagem]);

} catch (PDOException $e) {
    // 9. Tratamento de erro
    // Deve ser enviado um status de erro para o front-end em produção
    error_log("Erro ao excluir acesso: " . $e->getMessage()); 
    echo json_encode(["erro" => "Erro ao excluir o acesso: " . $e->getMessage()]);
}

?>