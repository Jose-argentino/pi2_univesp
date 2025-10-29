<?php
include "partes/validaSession.php";
include "partes/conexao.php";

// Verifica se recebeu o ID pela URL
if (!isset($_GET['id'])) {
    echo "<script>alert('Registro não identificado!'); window.location.href='cadastroAcesso.php';</script>";
    exit;
}

$id = intval($_GET['id']);

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, niv_acesso, obs FROM tb_acesso WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $acesso = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$acesso) {
        echo "<script>alert('Registro não encontrado!'); window.location.href='cadastroAcesso.php';</script>";
        exit;
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/geral.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="stylesheet" href="../css/footerExterno.css">
    <title>Editar Nível de Acesso</title>
</head>
<body>
<header>
    <?php include "partes/menuInterno.php"; ?>
</header>

<main>
    <h2>Editar Nível de Acesso</h2>

    <form action="php/atualizaAcesso.php" method="POST">
        <input type="hidden" name="id" value="<?= $acesso['id'] ?>">

        <label>Nível de Acesso:</label><br>
        <input type="text" name="niv_acesso" value="<?= htmlspecialchars($acesso['niv_acesso']) ?>" required><br><br>

        <label>Observações:</label><br>
        <textarea name="obs"><?= htmlspecialchars($acesso['obs']) ?></textarea><br><br>

        <button type="submit" class="btnCadastrar">Salvar Alterações</button>
        <button type="button" class="btnCadastrar" onclick="window.location.href='../cadastroAcesso.php'">Cancelar</button>
    </form>
</main>

<footer>
    <?php include "partes/footerInterno.php"; ?>
</footer>
</body>
</html>