<?php
$servername = "sql104.infinityfree.com"; // HOSTNAME MYSQL (vem no painel)
$username   = "if0_40354608";             // NOME DE UTILIZADOR MYSQL
$password   = "8ry90zTu7m1";              // PALAVRA-PASSE MYSQL (a do painel)
$database   = "if0_40354608_db_loja_roupa"; // NOME DA BASE DE DADOS

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão bem-sucedida!"; // opcional pra testar
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
