<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$db = "cooperativa";

$conexao = new mysqli($host, $usuario, $senha, $db);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}
?>