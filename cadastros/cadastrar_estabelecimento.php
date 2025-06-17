<?php
include("../db/conexao.php");

$mensagem = "";
$caminho_foto = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao'];
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $pasta_uploads = "uploads/";
        if (!is_dir($pasta_uploads)) {
            mkdir($pasta_uploads, 0755, true);
        }
        
        $nome_arquivo = uniqid() . '_' . basename($_FILES['foto']['name']);
        $caminho_foto = $pasta_uploads . $nome_arquivo;
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto)) {
        } else {
            $mensagem = "Erro ao fazer upload da foto.";
        }
    }
    
    $sql = "INSERT INTO estabelecimentos (nome, endereco, descricao, foto) 
            VALUES ('$nome', '$endereco', '$descricao', '$caminho_foto')";
    
    if ($conexao->query($sql)) {
        $mensagem = "Estabelecimento cadastrado com sucesso!";
    } else {
        $mensagem = "Erro: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Estabelecimento</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <a href="../index.php" class="botao-voltar">← Voltar</a>
    <h2>Cadastrar Estabelecimento</h2>

    <?php if (!empty($mensagem)): ?>
        <div class="mensagem"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <label>Nome do Estabelecimento:</label><br>
        <input type="text" name="nome" required><br><br>
        
        <label>Endereço:</label><br>
        <textarea name="endereco" required></textarea><br><br>
        
        <label>Descrição (opcional):</label><br>
        <textarea name="descricao"></textarea><br><br>
        
        <label>Foto da Fachada:</label><br>
        <input type="file" name="foto" accept="image/*"><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>

</body>
</html>