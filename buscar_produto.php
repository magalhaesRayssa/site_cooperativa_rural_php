<?php
include("db/conexao.php");

if (isset($_GET['excluir'])) {
    $id = (int)$_GET['excluir'];
    $conexao->query("DELETE FROM produtos WHERE id = $id");
    header("Location: buscar_produto.php?sucesso=1&busca=" . urlencode($_GET['busca']));
    exit();
}

$mensagem = "";
if (isset($_GET['sucesso'])) {
    $mensagem = '<div class="mensagem sucesso">Produto excluído com sucesso!</div>';
}

$busca = $_GET['busca'] ?? '';
$resultado = null;

if (!empty($busca)) {
    $sql = "SELECT p.id, p.nome, p.descricao, p.foto, pr.nome AS produtor 
            FROM produtos p
            JOIN produtores pr ON p.id_produtor = pr.id
            WHERE p.nome LIKE ? 
            ORDER BY p.nome";
    
    $stmt = $conexao->prepare($sql);
    $termo_busca = "%$busca%";
    $stmt->bind_param("s", $termo_busca);
    $stmt->execute();
    $resultado = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buscar Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <a href="index.php" class="botao-voltar">← Voltar</a>
    <h2>Buscar Produto</h2>

    <form method="GET" action="" class="form-busca">
        <input type="text" name="busca" value="<?= htmlspecialchars($busca) ?>" 
               placeholder="Digite o nome do produto" required>
        <input type="submit" value="Buscar">
    </form>

    <?= $mensagem ?>

    <?php if (!empty($busca)): ?>
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <div class="lista-resultados">
                <?php while($produto = $resultado->fetch_assoc()): ?>
                    <div class="card-produto">
                        <div class="cabecalho-card">
                            <h3><?= htmlspecialchars($produto['nome']) ?></h3>
                            <a href="excluir.php?tabela=produtos&id=<?= $produto['id'] ?>&busca=<?= urlencode($busca) ?>" 
                               class="botao-excluir">
                               Excluir
                            </a>
                        </div>
                        
                        <p><strong>Produtor:</strong> <?= htmlspecialchars($produto['produtor']) ?></p>
                        
                        <?php if (!empty($produto['descricao'])): ?>
                            <p><strong>Descrição:</strong> <?= htmlspecialchars($produto['descricao']) ?></p>
                        <?php endif; ?>
                        
                        <?php if (!empty($produto['foto'])): ?>
                            <img src="<?= htmlspecialchars($produto['foto']) ?>" class="foto-produto">
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="sem-resultados">Nenhum produto encontrado para "<?= htmlspecialchars($busca) ?>"</p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>