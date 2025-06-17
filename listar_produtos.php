<?php
include("db/conexao.php");

$mensagem = "";
if (isset($_GET['sucesso'])) {
    $mensagem = '<div class="mensagem sucesso">Produto excluído com sucesso!</div>';
} elseif (isset($_GET['erro'])) {
    $mensagem = '<div class="mensagem erro">Erro ao excluir: ' . htmlspecialchars($_GET['erro']) . '</div>';
}

$sql = "SELECT 
            p.id AS produto_id,
            p.nome AS produto,
            p.descricao,
            p.foto,
            pr.nome AS produtor,
            GROUP_CONCAT(e.nome SEPARATOR ', ') AS estabelecimentos
        FROM produtos p
        JOIN produtores pr ON p.id_produtor = pr.id
        LEFT JOIN produto_estabelecimento pe ON p.id = pe.id_produto
        LEFT JOIN estabelecimentos e ON pe.id_estabelecimento = e.id
        GROUP BY p.id
        ORDER BY p.nome";

$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <a href="index.php" class="botao-voltar">← Voltar</a>
    <h2>Produtos Cadastrados</h2>

    <?= $mensagem ?>

    <?php if ($resultado->num_rows > 0): ?>
        <div class="lista-produtos">
            <?php while($produto = $resultado->fetch_assoc()): ?>
                <div class="card-produto">
                    <div class="cabecalho-card">
                        <h3><?= htmlspecialchars($produto['produto']) ?></h3>
                        <a href="excluir.php?tabela=produtos&id=<?= $produto['produto_id'] ?>" 
                           class="botao-excluir">
                           Excluir
                        </a>
                    </div>

                    <p><strong>Produtor:</strong> <?= htmlspecialchars($produto['produtor']) ?></p>
                    
                    <?php if (!empty($produto['descricao'])): ?>
                        <p><strong>Descrição:</strong> <?= htmlspecialchars($produto['descricao']) ?></p>
                    <?php endif; ?>
                    
                    <?php if (!empty($produto['estabelecimentos'])): ?>
                        <p><strong>Disponível em:</strong> <?= htmlspecialchars($produto['estabelecimentos']) ?></p>
                    <?php endif; ?>
                    
                    <?php if (!empty($produto['foto'])): ?>
                        <img src="<?= htmlspecialchars($produto['foto']) ?>" alt="Foto do produto" class="foto-produto">
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Nenhum produto cadastrado ainda.</p>
    <?php endif; ?>

</body>
</html>