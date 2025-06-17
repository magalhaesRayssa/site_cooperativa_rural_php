<?php
include("db/conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produto = $_POST["produto"];
    $id_estabelecimento = $_POST["estabelecimento"];
    
    $sql = "INSERT INTO produto_estabelecimento (id_produto, id_estabelecimento) 
            VALUES ('$id_produto', '$id_estabelecimento')";
    
    if ($conexao->query($sql)) {
        $mensagem = "Produto vinculado com sucesso!";
    } else {
        $mensagem = "Erro: " . $conexao->error;
    }
}

$produtos = $conexao->query("SELECT id, nome FROM produtos ORDER BY nome");
$estabelecimentos = $conexao->query("SELECT id, nome FROM estabelecimentos ORDER BY nome");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vincular Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <a href="index.php" class="botao-voltar">← Voltar</a>
    <h2>Vincular Produto a Estabelecimento</h2>

    <?php if (!empty($mensagem)): ?>
        <div class="mensagem"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="campo-form">
            <label>Produto:</label>
            <select name="produto" required>
                <option value="">Selecione um produto</option>
                <?php while($p = $produtos->fetch_assoc()): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="campo-form">
            <label>Estabelecimento:</label>
            <select name="estabelecimento" required>
                <option value="">Selecione um estabelecimento</option>
                <?php while($e = $estabelecimentos->fetch_assoc()): ?>
                    <option value="<?= $e['id'] ?>"><?= $e['nome'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <br>
        <input type="submit" value="Vincular">
    </form>

</body>
</html>