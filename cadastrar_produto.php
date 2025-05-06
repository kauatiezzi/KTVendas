<?php
require 'conexao.php';

$nome = $_POST['nome'];
$preco = $_POST['preco'];

$stmt = $pdo->prepare("INSERT INTO produtos (nome, preco) VALUES (?, ?)");
$stmt->execute([$nome, $preco]);

header("Location: dashboard.php");
?>
