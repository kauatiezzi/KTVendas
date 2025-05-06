<?php
require 'conexao.php';

$cliente_id = $_POST['cliente_id'];
$produto_id = $_POST['produto_id'];
$quantidade = (int)$_POST['quantidade'];

// Registrar a venda
$stmt = $pdo->prepare("INSERT INTO vendas (cliente_id, produto_id, quantidade) VALUES (?, ?, ?)");
$stmt->execute([$cliente_id, $produto_id, $quantidade]);

// Buscar dados do cliente
$stmt = $pdo->prepare("SELECT brigadeiros, resgates FROM clientes WHERE id = ?");
$stmt->execute([$cliente_id]);
$cliente = $stmt->fetch();

$brigadeiros = $cliente['brigadeiros'] + $quantidade;
$resgates = $cliente['resgates'];
$mensagem_bonus = "";

// Verificar se houve resgate
if ($brigadeiros >= 10) {
  $bonus = intdiv($brigadeiros, 10);
  $resgates += $bonus;
  $brigadeiros = $brigadeiros % 10;
  $mensagem_bonus = "🎉 O cliente ganhou $bonus brigadeiro(s) grátis!";

  // Registrar no histórico de resgates
  $stmt = $pdo->prepare("INSERT INTO resgates (cliente_id, quantidade) VALUES (?, ?)");
  $stmt->execute([$cliente_id, $bonus]);
}


// Atualizar contagem
$stmt = $pdo->prepare("UPDATE clientes SET brigadeiros = ?, resgates = ? WHERE id = ?");
$stmt->execute([$brigadeiros, $resgates, $cliente_id]);

// Redirecionar com mensagem
header("Location: cliente.php?id=$cliente_id&bonus=" . urlencode($mensagem_bonus));
exit;
?>
