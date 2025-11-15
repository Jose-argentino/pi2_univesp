<?php
include "../php/partes/conexao.php"; 

// Define que a resposta será JSON, ideal para comunicação com AJAX/Fetch
header('Content-Type: application/json; charset=utf-8');


$id_acesso = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

//Verifica se o ID é válido
if (!$id_acesso) {
    echo json_encode(["erro" => "ID de acesso inválido ou não fornecido."]);
    exit;
}

try {
    //Conexão com PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM tb_acesso WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([$id_acesso]);

    if ($stmt->rowCount() > 0) {
        $mensagem = "Nível de acesso excluído com sucesso!";
        
    } else {
        $mensagem = "Aviso: Nenhum registro encontrado para o ID " . $id_acesso . ".";
    }
    
    echo json_encode(["sucesso" => $mensagem]);

} catch (PDOException $e) {
    // 9. Tratamento de erro
    error_log("Erro ao excluir acesso: " . $e->getMessage()); 
    echo json_encode(["erro" => "Erro ao excluir o acesso: " . $e->getMessage()]);
}

?>