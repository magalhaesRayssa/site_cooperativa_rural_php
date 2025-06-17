<?php
include("../db/conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $id_produtor = $_POST["id_produtor"];
    $foto = "";

    if (!empty($_FILES["foto"]["name"])) {
        $pasta = "uploads/";
        $nome_arquivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $caminho_foto = $pasta . $nome_arquivo;
        
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho_foto)) {
            $foto = $caminho_foto;
        }
    }

    $sql = "INSERT INTO produtos (id_produtor, nome, descricao, foto) 
            VALUES ('$id_produtor', '$nome', '$descricao', '$foto')";
    
    if ($conexao->query($sql)) {
        $mensagem = "Produto cadastrado com sucesso!";
    } else {
        $mensagem = "Erro: " . $conexao->error;
    }
}

$produtores = $conexao->query("SELECT id, nome FROM produtores ORDER BY nome");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <a href="../index.php" class="botao-voltar">← Voltar</a>
    <h2>Cadastrar Produto</h2>

    <?php if (!empty($mensagem)): ?>
        <div class="mensagem"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>
        
        <label>Descrição:</label><br>
        <textarea name="descricao"></textarea><br><br>
        
        <label>Foto:</label><br>
        <input type="file" name="foto"><br><br>
        
        <label>Produtor:</label><br>
        <select name="id_produtor" required>
            <option value="">Selecione</option>
            <?php while($p = $produtores->fetch_assoc()): ?>
                <option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
            <?php endwhile; ?>
        </select>
        <br><br>
        <input type="submit" value="Cadastrar">
    </form>

</body>
</html>