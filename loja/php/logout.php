<?php
session_start();       // Garante que a sessão esteja ativa
session_unset();       // Remove todas as variáveis da sessão
session_destroy();     // Encerra a sessão

// Redireciona de volta para o login
header("Location: ../../index.php?erro=" . urlencode("Sessão encerrada com sucesso"));
exit;
?>
