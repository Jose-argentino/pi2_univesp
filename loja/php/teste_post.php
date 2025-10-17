<?php

        echo "<h1>$id</h1>";

session_start();
require_once "partes/conexao.php";

echo "<pre>";
print_r($_POST);
echo "</pre>";
exit;
?>


