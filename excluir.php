<?php
include("db/conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tabela = $_POST["tabela"];
    $id = (int)$_POST["id"];

    $tabelas_permitidas = ['produtos', 'produtores', 'estabelecimentos'];

    if (in_array($tabela, $tabelas_permitidas)) {
        $sql = "DELETE FROM $tabela WHERE id = $id";

        if ($conexao->query($sql)) {
            header("Location: listar_produtos.php?sucesso=1");
        } else {
            header("Location: listar_produtos.php?erro=" . urlencode($conexao->error));
        }
    } else {
        header("Location: listar_produtos.php?erro=Tabela+inválida");
    }
    exit();
}

$tabela = $_GET["tabela"] ?? '';
$id = (int)($_GET["id"] ?? 0);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Confirmar Exclusão</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <h2>Confirmar Exclusão</h2>
        <p>Tem certeza que deseja excluir este item?</p>

        <form method="POST" action="excluir.php">
            <input type="hidden" name="tabela" value="<?= htmlspecialchars($tabela) ?>">
            <input type="hidden" name="id" value="<?= $id ?>">

            <button type="submit" class="botao-excluir">Sim, Excluir</button>
            <a href="listar_produtos.php" class="botao-voltar">Cancelar</a>
        </form>
    </div>

</body>

</html>