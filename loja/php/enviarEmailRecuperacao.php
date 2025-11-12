<?php
// senha:Teste 01 email +
// email:j.argentino.ti@gmail.com
// dominio:sandbox0a73c8350fb542e582aec513d45d62b5.mailgun.org
// chave:// 88b1ca9f-90336efd
?>

<?php
$domain = 'sandbox0a73c8350fb542e582aec513d45d62b5.mailgun.org'; 
$apiKey = '88b1ca9f-90336efd'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16)); // gera token aleatório
    $link = "https://seusite.com/loja/php/novaSenha.php?token=$token";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.mailgun.net/v3/{$domain}/messages");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "api:{$apiKey}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'from'    => 'Suporte <postmaster@sandbox0a73c8350fb542e582aec513d45d62b5.mailgun.org>',
        'to'      => $email,
        'subject' => 'Recuperação de Senha - SJ Moda',
        'html'    => "<p>Olá!</p>
                      <p>Clique para redefinir sua senha: 
                      <a href='{$link}'>Redefinir senha</a></p>
                      <p>Se você não solicitou, ignore este e-mail.</p>"
    ]);

    $result = curl_exec($ch);
    $error  = curl_error($ch);
    curl_close($ch);

    if ($error) {
        echo "<script>alert('Erro ao enviar: $error'); window.history.back();</script>";
    } else {
        echo "<script>alert('E-mail de recuperação enviado! Verifique sua caixa de entrada.'); window.location.href='../../index.php';</script>";
    }
} else {
    echo "Acesso inválido.";
}
?>
