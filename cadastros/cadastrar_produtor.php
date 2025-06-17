<?php
include("../db/conexao.php");

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "INSERT INTO produtores (nome, email) VALUES ('$nome', '$email')";

    if ($conexao->query($sql)) {
        $mensagem = "Produtor cadastrado com sucesso!";
    } else {
        $mensagem = "Erro: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cadastro de Produtor</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <a href="../index.php" class="botao-voltar">← Voltar</a>

    <h2>Cadastrar Produtor</h2>

    <?php if (isset($mensagem)): ?>
        <div class="mensagem"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Nome do Produtor:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email (opcional):</label><br>
        <input type="email" name="email"><br><br>

        <input type="submit" value="Cadastrar">
    </form>

</body>

</html>