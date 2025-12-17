<?php
  // Configurações do servidor de banco de dados
  $servername = "localhost";  // Host (localhost porque está no XAMPP)
  $username   = "root";       // Usuário padrão do MySQL no XAMPP
  $password   = "123456";           // Senha (em branco por padrão no XAMPP)
  $database   = "db_loja_roupa"; // Nome do banco de dados que você criou

  try {
      // Cria a conexão usando PDO
      $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

      // Define o modo de erro do PDO para lançar exceções
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Se quiser testar:
      // echo "Conexão realizada com sucesso!";
  } catch (PDOException $e) {
      // Caso ocorra erro, exibe a mensagem
      echo "Falha na conexão: " . $e->getMessage();
    }