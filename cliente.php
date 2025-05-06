<?php
require 'conexao.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch();

$stmt = $pdo->prepare("SELECT vendas.*, produtos.nome AS produto FROM vendas
    JOIN produtos ON vendas.produto_id = produtos.id
    WHERE cliente_id = ?");
$stmt->execute([$id]);
$vendas = $stmt->fetchAll();

if (!empty($_GET['bonus'])) {
  echo "<script>window.onload = function() { showModal('".$_GET['bonus']."'); }</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Paleta de cores de doceria */
        :root {
            --brown-light: #d4b19b;
            --brown-dark: #5e3a3a;
            --cream: #f3e1d1;
            --pink: #f1b6b6;
        }

        /* Estilos do modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fundo transparente */
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 400px;
        }

        .close {
            background-color: #d4b19b;
            color: white;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .close:hover {
            background-color: #5e3a3a;
        }
    </style>
</head>
<body class="bg-cream min-h-screen flex flex-col">

    <!-- Barra Superior -->
    <header class="bg-[#5e3a3a] text-white py-4 px-6 flex items-center justify-between sm:px-8">
        <div class="flex items-center space-x-4">
            <img src=".\assets\imagens\logo.png" alt="Logo" class="h-16 w-34 rounded-full">
        </div>
        <nav>
        <a href="clientes.php" class="w-full bg-[#d4b19b] text-white font-semibold py-3 px-6 rounded-lg" >Voltar</a>
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="flex-grow px-4 py-8 sm:px-6">

        <!-- Dados do Cliente -->
        <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto mb-6">
            <h2 class="text-2xl font-bold text-[#5e3a3a] mb-4"><?= $cliente['nome'] ?> (<?= $cliente['telefone'] ?>)</h2>
            <p class="text-lg mb-2">Total de brigadeiros: <?= $cliente['brigadeiros'] ?></p>
            <p class="text-lg mb-4">Resgates: <?= $cliente['resgates'] ?></p>
        </div>

        <!-- Registrar Nova Venda -->
        <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto mb-6">
            <h3 class="text-xl font-semibold text-[#5e3a3a] mb-4">Registrar Nova Venda</h3>
            <form action="cadastrar_venda.php" method="POST" class="space-y-6">
                <input type="hidden" name="cliente_id" value="<?= $cliente['id'] ?>">
                
                <label for="produto_id" class="block text-[#5e3a3a]">Produto:</label>
                <select name="produto_id" class="w-full p-3 border border-[#d4b19b] rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-[#5e3a3a]">
                    <?php
                    $produtos = $pdo->query("SELECT * FROM produtos")->fetchAll();
                    foreach ($produtos as $p) {
                        echo "<option value='{$p['id']}'>{$p['nome']}</option>";
                    }
                    ?>
                </select>

                <label for="quantidade" class="block text-[#5e3a3a]">Quantidade:</label>
                <div class="flex items-center justify-center space-x-4 mb-6">
                    <button type="button" onclick="decrement()" class="bg-[#d4b19b] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5e3a3a] transition w-16">-</button>
                    <input type="number" name="quantidade" id="quantidade" class="w-16 text-center p-3 border border-[#d4b19b] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5e3a3a]" value="1" min="1" readonly>
                    <button type="button" onclick="increment()" class="bg-[#d4b19b] text-white font-semibold py-2 px-4 rounded-lg hover:bg-[#5e3a3a] transition w-16">+</button>
                </div>

                <button type="submit" class="bg-[#d4b19b] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#5e3a3a] transition w-full sm:w-auto mx-auto block">Registrar</button>
            </form>
        </div>

        <!-- Histórico de Compras -->
        <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto mb-6">
            <h3 class="text-xl font-semibold text-[#5e3a3a] mb-4">Histórico de Compras</h3>
            <ul class="space-y-2">
                <?php foreach ($vendas as $v): ?>
                    <li class="text-lg"><?= $v['quantidade'] ?> x <?= $v['produto'] ?> em <?= date('d/m/Y H:i', strtotime($v['data'])) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Histórico de Resgates -->
        <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
            <h3 class="text-xl font-semibold text-[#5e3a3a] mb-4">Histórico de Resgates</h3>
            <ul class="space-y-2">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM resgates WHERE cliente_id = ? ORDER BY data DESC");
                $stmt->execute([$cliente['id']]);
                $resgates = $stmt->fetchAll();

                if (count($resgates) == 0) {
                    echo "<li class='text-lg'>Nenhum resgate ainda.</li>";
                } else {
                    foreach ($resgates as $r) {
                        echo "<li class='text-lg'>{$r['quantidade']} brigadeiro(s) grátis em " . date('d/m/Y H:i', strtotime($r['data'])) . "</li>";
                    }
                }
                ?>
            </ul>
        </div>

    </main>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <p id="modal-text" class="text-lg text-[#5e3a3a]"></p>
            <button class="close" onclick="closeModal()">Fechar</button>
        </div>
    </div>

    <script>
        // Função para mostrar o modal
        function showModal(message) {
            document.getElementById("modal-text").textContent = message;
            document.getElementById("modal").style.display = "flex";
        }

        // Função para fechar o modal
        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }

        // Funções de incremento e decremento
        function increment() {
            var quantidadeInput = document.getElementById("quantidade");
            quantidadeInput.value = parseInt(quantidadeInput.value) + 1;
        }

        function decrement() {
            var quantidadeInput = document.getElementById("quantidade");
            if (parseInt(quantidadeInput.value) > 1) {
                quantidadeInput.value = parseInt(quantidadeInput.value) - 1;
            }
        }
    </script>

</body>
</html>
