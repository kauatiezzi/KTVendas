<?php
require 'conexao.php';

$busca = $_GET['telefone'] ?? '';
$sql = $busca
    ? "SELECT * FROM clientes WHERE telefone LIKE ?"
    : "SELECT * FROM clientes";

$stmt = $pdo->prepare($sql);
$busca ? $stmt->execute(["%$busca%"]) : $stmt->execute();
$clientes = $stmt->fetchAll();
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
    </style>
</head>
<body class="bg-cream min-h-screen flex flex-col">

    <!-- Barra Superior -->
    <header class="bg-[#5e3a3a] text-white py-4 px-6 flex items-center justify-between sm:px-8">
        <div class="flex items-center space-x-4">
            <img src=".\assets\imagens\logo.png" alt="Logo" class="h-16 w-34 rounded-full">
        </div>
        <nav>
        <a href="dashboard.php" class="w-full bg-[#d4b19b] text-white font-semibold py-3 px-6 rounded-lg" >Voltar</a>
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="flex-grow px-4 py-8">

        <!-- Formulário de Busca -->
        <div class="mb-6 bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <h2 class="text-2xl font-bold text-[#5e3a3a] mb-4">Buscar Clientes</h2>
            <form method="GET" class="flex space-x-4">
                <input type="text" name="telefone" class="w-full p-3 border border-[#d4b19b] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5e3a3a]" placeholder="Digite o telefone">
                <button type="submit" class="bg-[#d4b19b] text-white font-semibold py-3 px-6 rounded-lg hover:bg-[#5e3a3a] transition">Buscar</button>
            </form>
        </div>

        <!-- Lista de Clientes -->
        <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-[#5e3a3a] mb-6">Clientes</h2>
            <ul class="space-y-4">
                <?php foreach ($clientes as $c): ?>
                    <li class="p-4 border-b border-[#d4b19b]">
                        <a href="cliente.php?id=<?= $c['id'] ?>" class="block text-[#5e3a3a] font-semibold hover:text-[#5e3a3a] hover:underline transition">
                            <?= $c['nome'] ?> - <?= $c['telefone'] ?> (<?= $c['brigadeiros'] ?> brigadeiros)
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </main>

</body>
</html>
