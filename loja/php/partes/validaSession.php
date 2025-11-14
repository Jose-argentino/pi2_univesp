<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado e se pertence ao sistema correto
if (
    !isset($_SESSION['id_sistema']) || $_SESSION['id_sistema'] != '_Loja_roupa' ||
    !isset($_SESSION['id_usuario']) || 
    !isset($_SESSION['nome']) ||
    !isset($_SESSION['nivel_acesso'])
) {
    // Redireciona se não estiver logado corretamente
    header("Location: ../index.php?erro=" . urlencode("Acesso não autorizado, realize o Login."));
    exit;
}
?>


